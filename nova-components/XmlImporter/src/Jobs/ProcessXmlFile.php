<?php

namespace Nulisec\XmlImporter\Jobs;

use App\Enums\RemoteType;
use App\Models\Product;
use App\Models\Unit;
use App\Services\XmlProductProcessor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Prewk\XmlStringStreamer;

class ProcessXmlFile implements ShouldQueue
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
    protected $filePath;

    /**
     * @var string
     */
    protected $encoding;

    /**
     * @var Store
     */
    protected $store;

    /**
     * @var object
     */
    protected $settings;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
        $this->encoding = XmlProductProcessor::detectFileEncoding($filePath);
        $this->store = $store;
        $this->settings = $store->loadDataObject('xml_importer_settings');
    }

    public function handle()
    {
        $streamer = XmlStringStreamer::createStringWalkerParser($this->filePath, ['captureDepth' => intval($this->settings->tag_depth), 'expectGT' => true]);
        $config = $this->store->loadDataObject('xml_importer', true);

        while ($node = $streamer->getNode()) {
            if (XmlProductProcessor::validateElement($node, $this->settings->tag_name)) {
                $productData = XmlProductProcessor::processNode(XmlProductProcessor::convertToUtf8($this->encoding, $node), $config);
                $this->processProductData($productData);
            }
        }
    }

    private function processProductData(array $data)
    {
        /** @var Product $product */
        if ($product = $this->store->products()->where($this->settings->identifier, $data[$this->settings->identifier])->first()) {
            $product->update($data);
        } else {
            $product = $this->store->products()->create($data);
            $product->setRemoteSync(null, RemoteType::XML_IMPORTER);
        }

        $this->processCategories($product, $data['category']);

        if ($unit = Unit::whereLike('name_v', $data['unit'])->first()) {
            $product->unit()->associate($unit);
        } else {
            $product->unit()->associate(preferenceRepository()->getDefaultQuantitativeUnit());
        }

        if ($data['quantity_in_stock'] > 0) {
            $product->availability()->associate(preferenceRepository()->getDefaultInStockAvailability());
        } else {
            $product->availability()->associate(preferenceRepository()->getDefaultOutOfStockAvailability());
        }

        if ($priceLevel = $this->store->defaultPriceLevel) {
            $product->prices()->updateOrCreate(['price_level_id' => $priceLevel->id], [
                'price' => normalizeNumber($data['price']) * $this->settings->price_multiplier,
            ]);
        }

        if ($this->resyncPhotos) {
            $product->clearMediaCollection('photos');
        }

        if (!empty($data['photo']) && !$product->hasMedia('photos')) {
            $product->addMediaFromUrl($data['photo'], 'image/jpeg', 'image/png')->toMediaCollection('photos');
        }

        return $product->save();
    }

    protected function processCategories($product, $categories)
    {
        $categories = explode('|', $categories);

        $category = $this->store->categories()->firstOrCreate(['name' => trim(end($categories))]);

        return $product->categories()->sync($category->id);
    }
}
