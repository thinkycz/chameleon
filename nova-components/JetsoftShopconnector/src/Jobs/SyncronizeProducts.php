<?php

namespace Nulisec\JetsoftShopconnector\Jobs;

use App\Abstracts\SyncJob;
use App\Enums\SettingType;
use App\Models\PriceLevel;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Unit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Nulisec\JetsoftShopconnector\Models\Zbozi;

class SyncronizeProducts extends SyncJob implements ShouldQueue
{
    /**
     * @var string
     */
    public static $jobName = 'Shopconnector Sync';

    /**
     * @var string
     */
    protected $statusCode = 'shopconnector_status';

    /**
     * @var Zbozi
     */
    protected $data;

    /**
     * @var object
     */
    private $settings;

    protected function prepare()
    {
        parent::prepare();

        $this->settings = Setting::loadConfiguration('shopconnector');
    }

    public function handle()
    {
        $this->prepare();

        $this->syncProducts();
    }

    protected function syncProducts()
    {
        $query = Zbozi::query()
            ->whereHas('obchod', function ($query) {
                $query->where('Nazev', $this->settings['eshopname']);
            })
            ->where('sLanguage', 'CZ')
            ->with('cenikyCeny');

        $s5Produkty = $query->simplePaginate(1000);

        while ($s5Produkty) {
            $this->processBatch($s5Produkty->items());
            $s5Produkty = $s5Produkty->hasMorePages() ? $query->simplePaginate(1000, ['*'], 'page', $s5Produkty->currentPage() + 1) : null;
        }
    }

    protected function processBatch($items)
    {
        foreach ($items as $item) {
            $this->data = $item;
            $s5identifier = $this->settings['identifier'] == 'barcode' ? 'sCode' : 'sKatalog';

            $product = Product::updateOrCreate([$this->settings['identifier'] => $item->$s5identifier], [
                'availability_id' => $this->getAvailabilityId(normalizeNumber($item->quantityInStock)),
                'unit_id' => $this->getUnitId($item->sUnit),
                'quantity_in_stock' => normalizeNumber($item->quantityInStock),
                'vatrate' => normalizeNumber($item->nDPH),
                'name' => $item->sName,
                'barcode' => $item->sCode,
                'catalogue_number' => $item->sKatalog,
            ]);

            $this->handleProductPrices($product);
        }
    }

    protected function handleProductPrices(Product $product)
    {
        foreach (PriceLevel::all() as $priceLevel) {
            $cenik = $this->data->cenikyCeny->where('GUIPriceList', $this->resolvePriceLevel($priceLevel->import_code));

            if ($cenik) {
                $product->prices()->updateOrCreate(['price_level_id' => $priceLevel->id], [
                    'price'     => $cenik->nPrice ? normalizeNumber($cenik->nPrice) : null,
                    'old_price' => $cenik->nMarketPrice ? normalizeNumber($cenik->nMarketPrice) : null,
                ]);
            }
        }

        return $this;
    }

    protected function resolvePriceLevel($importCode)
    {
        $mapping = ['velkoobchod' => 'VELKO_'];

        return array_key_exists($importCode, $mapping) ? $mapping[$importCode] : null;
    }

    protected function getUnitId($abbr)
    {
        $unit = Unit::whereLike('abbr_v', $abbr)->first();
        return $unit ? $unit->id : 1;
    }

    protected function getAvailabilityId($quantity)
    {
        return $quantity <= 0 ? preferenceRepository()->getDefaultOutOfStockAvailability()->id : preferenceRepository()->getDefaultInStockAvailability()->id;
    }
}
