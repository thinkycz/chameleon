<?php

namespace Nulisec\XmlImporter\Jobs;

use App\Abstracts\SyncJob;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Unit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Nulisec\XmlImporter\Services\XmlProductProcessor;
use Prewk\XmlStringStreamer;

class ProcessXmlFile extends SyncJob implements ShouldQueue
{
    /**
     * @var string
     */
    protected $filePath;

    /**
     * @var string
     */
    protected $encoding;

    /**
     * @var object
     */
    protected $settings;

    /**
     * @var array
     */
    protected $data;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
        $this->encoding = XmlProductProcessor::detectFileEncoding($filePath);
        $this->settings = Setting::loadConfiguration('xml_importer_settings');
    }

    public function handle()
    {
        $streamer = XmlStringStreamer::createStringWalkerParser($this->filePath, ['captureDepth' => intval($this->settings['tag_depth']), 'expectGT' => true]);
        $config = Setting::loadConfiguration('xml_importer');

        while ($node = $streamer->getNode()) {
            if (XmlProductProcessor::validateElement($node, $this->settings['tag_name'])) {
                $raw = XmlProductProcessor::convertToUtf8($this->encoding, $node);
                $productData = XmlProductProcessor::processNode($raw, $config);
                $this->processProductData($productData);
            }
        }
    }

    private function processProductData(array $data)
    {
        $this->data = $data;

        $identifier = $this->settings['identifier'];

        $product = Product::updateOrCreate([$identifier => $data[$identifier]], $data);

        $this->handleProductCategories($product)
            ->handleProductStock($product)
            ->handleProductPrices($product)
            ->handleProductUnit($product)
            ->handleProductPhotos($product);

        return $product->save();
    }

    protected function handleProductCategories(Product $product)
    {
        $categories = explode('|', $this->data['category']);
        $categoryName = trim(end($categories));

        if ($categoryName) {
            $category = Category::firstOrCreateByName($categoryName);
            $product->categories()->sync($category->id);
        }

        return $this;
    }

    protected function handleProductStock(Product $product)
    {
        if ($this->data['quantity_in_stock'] > 0) {
            $product->availability()->associate(preferenceRepository()->getDefaultInStockAvailability());
        } else {
            $product->availability()->associate(preferenceRepository()->getDefaultOutOfStockAvailability());
        }

        return $this;
    }

    protected function handleProductPrices(Product $product)
    {
        if ($priceLevel = preferenceRepository()->getDefaultPriceLevel()) {
            $product->prices()->updateOrCreate(['price_level_id' => $priceLevel->id], [
                'price' => normalizeNumber($this->data['price']) * $this->settings['price_multiplier'],
            ]);
        }

        return $this;
    }

    protected function handleProductUnit(Product $product)
    {
        if ($unit = Unit::whereLike('name_v', $this->data['unit'])->first()) {
            $product->unit()->associate($unit);
        } else {
            $product->unit()->associate(preferenceRepository()->getDefaultQuantitativeUnit());
        }

        return $this;
    }

    protected function handleProductPhotos(Product $product)
    {
        if (!empty($this->data['photo']) && !$product->hasMedia('photos')) {
            $product->addMediaFromUrl($this->data['photo'], 'image/jpeg', 'image/png')->toMediaCollection('photos');
        }

        return $this;
    }
}
