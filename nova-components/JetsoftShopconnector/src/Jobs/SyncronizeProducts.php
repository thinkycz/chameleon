<?php

namespace Nulisec\JetsoftShopconnector\Jobs;

use App\Enums\SettingType;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Nulisec\JetsoftShopconnector\Models\Zbozi;

class SyncronizeProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Max 60 minutes
     *
     * @var int
     */
    public $timeout = 3600;

    /**
     * Max 1 try
     *
     * @var int
     */
    public $tries = 1;

    /**
     * @var string
     */
    protected $identifier;

    /**
     * @var
     */
    private $eshopname;

    /**
     * Create a new job instance.
     * @param $eshopname
     * @param $identifier
     */
    public function __construct($eshopname, $identifier)
    {
        $this->eshopname = $eshopname;
        $this->identifier = $identifier;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $query = Zbozi::query()
            ->whereHas('obchod', function ($query) {
                $query->where('Nazev', $this->eshopname);
            })
            ->where('sLanguage', 'CZ')
            ->with('cenikyCeny');

        $s5Produkty = $query->simplePaginate(1000);

        while ($s5Produkty) {
            $this->processBatch($s5Produkty->items());
            $s5Produkty = $s5Produkty->hasMorePages() ? $query->simplePaginate(1000, ['*'], 'page', $s5Produkty->currentPage() + 1) : null;
        }

        Product::makeAllSearchable();
    }

    protected function processBatch($items)
    {
        foreach ($items as $s5Produkt) {
            $s5identifier = $this->identifier == 'barcode' ? 'sCode' : 'sKatalog';
            $product = Product::where($this->identifier, $s5Produkt->$s5identifier)->first();
            Product::withoutSyncingToSearch(function () use ($product, $s5Produkt) {
                $product ? $this->updateProduct($product, $s5Produkt) : $this->createProduct($s5Produkt);
            });
        }
    }

    protected function updateProduct(Product $product, Zbozi $zbozi)
    {
        $quantity = normalizeNumber($zbozi->quantityInStock);
        $vat = normalizeNumber($zbozi->nDPH);

        $product->update([
            'availability_id' => $this->getAvailabilityId(normalizeNumber($zbozi->quantityInStock)),
            'unit_id' => $this->getUnitId($zbozi->sUnit),
            'quantityInStock' => $quantity,
            'vatrate' => $vat,
            'name' => array_fill_keys(['cs'], $zbozi->sName),
            'barcode' => $zbozi->sCode,
            'catalogueNumber' => $zbozi->sKatalog,
        ]);

        $this->handlePrices($product, $zbozi, $vat);

        return $product;
    }

    protected function createProduct(Zbozi $zbozi)
    {
        $vat = normalizeNumber($zbozi->nDPH);

        $product = Product::create([
            'availability_id' => $this->getAvailabilityId(normalizeNumber($zbozi->quantityInStock)),
            'unit_id' => $this->getUnitId($zbozi->sUnit),
            'quantityInStock' => normalizeNumber($zbozi->quantityInStock),
            'vatrate' => $vat,
            'name' => $zbozi->sName,
            'barcode' => $zbozi->sCode,
            'catalogueNumber' => $zbozi->sKatalog,
        ]);

        $this->handlePrices($product, $zbozi, $vat);

        return $product;
    }

    protected function handlePrices(Product $product, Zbozi $zbozi, $vat)
    {
        $prices = [];

        foreach ($zbozi->cenikyCeny as $cena) {
            $currency = $cena->sCurrency;
            $priceLevel = $this->resolvePriceLevel($cena->GUIPriceList);

            if ($currency && $priceLevel) {
                $prices[$priceLevel][$currency]['old'] = $cena->nMarketPrice * ($vat + 100) / 100;
                $prices[$priceLevel][$currency]['new'] = $cena->nPrice * ($vat + 100) / 100;
            }
        }

        $product->processPrices($prices);

        return $this;
    }

    protected function resolvePriceLevel($GUIPriceList)
    {
        $mapping = ['VELKO_' => 'velkoobchod'];

        return array_key_exists($GUIPriceList, $mapping) ? $mapping[$GUIPriceList] : null;
    }

    protected function getUnitId($unitAbbr)
    {
        $unit = Unit::where('abbr->cs', $unitAbbr)->first();
        return $unit ? $unit->id : 1;
    }

    protected function getAvailabilityId($quantity)
    {
        return $quantity <= 0 ? sharedData()->getDefaultOutOfStockAvailability()->id : sharedData()->getDefaultInStockAvailability()->id;
    }
}
