<?php

namespace Nulisec\GoogleSheetsImporter\Jobs;

use App\Abstracts\SyncJob;
use App\Models\Category;
use App\Models\PriceLevel;
use App\Models\Product;
use App\Models\PropertyType;
use App\Models\Setting;
use App\Models\Unit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;

class SyncFromGoogleSheets extends SyncJob implements ShouldQueue
{
    /**
     * @var string
     */
    public static $jobName = 'Google Sheets Sync';

    /**
     * @var string
     */
    protected $statusCode = 'google_sheets_status';

    /**
     * @var Collection
     */
    protected $data;

    /**
     * @var object
     */
    protected $settings;

    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @var mixed
     */
    protected $results;

    protected function prepare()
    {
        parent::prepare();

        $this->settings = Setting::loadConfiguration('google_sheets_importer');
        $this->endpoint = $this->buildEndpointFromShareLink($this->settings['link']);

        $data = file_get_contents($this->endpoint);
        $this->results = $data ? json_decode($data)->{'feed'}->{'entry'} : [];
    }

    public function handle()
    {
        $this->prepare();

        $this->syncProducts();
    }

    protected function syncProducts()
    {
        /** @var Product $product */

        foreach ($this->results as $result) {
            $this->data = collect($result);

            $product = Product::updateOrCreate([
                $this->settings['identifier'] => $this->getFromData($this->settings['identifier']),
            ], $this->getFromData([
                'name',
                'description',
                'details',
                'catalogue_number',
                'barcode',
                'minimum_order_quantity',
                'vatrate',
            ]));

            $this->handleProductCategories($product)
                ->handleProductStock($product)
                ->handleProductPrices($product)
                ->handleProductProperties($product)
                ->handleProductOptions($product)
                ->handleProductUnit($product);
        }
    }

    protected function handleProductCategories(Product $product)
    {
        if ($categories = $this->getFromData('categories')) {
            $categoriesToSync = collect(explode('|', $categories))
                ->map(function ($name) {
                    return trim($name);
                })
                ->filter(function ($name) {
                    return !empty($name);
                })
                ->map(function ($name) {
                    return Category::firstOrCreateByName($name)->id;
                })
                ->unique();

            $product->categories()->sync($categoriesToSync);
        }

        return $this;
    }

    protected function handleProductStock(Product $product)
    {
        if ($quantity = $this->getFromData('quantity_in_stock')) {
            $availability = $quantity > 0 ?
            preferenceRepository()->getDefaultInStockAvailability() :
            preferenceRepository()->getDefaultOutOfStockAvailability();

            $product->update([
                'quantity_in_stock' => $quantity,
                'availability_id'   => $availability->id,
            ]);
        }

        return $this;
    }

    protected function handleProductPrices(Product $product)
    {
        foreach (PriceLevel::whereEnabled(true)->get() as $priceLevel) {
            $price = $this->getFromData("price.{$priceLevel->import_code}");
            $oldprice = $this->getFromData("old_price.{$priceLevel->import_code}");

            if ($price) {
                $product->prices()->updateOrCreate(['price_level_id' => $priceLevel->id], [
                    'price'     => $price ? normalizeNumber($price) : null,
                    'old_price' => $oldprice ? normalizeNumber($oldprice) : null,
                ]);
            }
        }

        return $this;
    }

    protected function handleProductProperties(Product $product)
    {
        $properties = $this->getMatchingData('property');

        $properties->each(function ($value, $key) use ($product) {
            if ($propertyType = PropertyType::where('code', $key)->first()) {
                $product->addProperty($value, $propertyType->id);
            }
        });

        return $this;
    }

    protected function handleProductOptions(Product $product)
    {
        $options = $this->getMatchingData('option');

        $options->each(function ($values, $key) use ($product) {
            if ($propertyType = PropertyType::where('code', $key)->first()) {
                collect(explode('|', $values))
                    ->map(function ($value) {
                        return trim($value);
                    })
                    ->filter(function ($value) {
                        return !empty($value);
                    })
                    ->each(function ($value) use ($product, $propertyType) {
                        $product->addProperty($value, $propertyType->id, true);
                    });
            }
        });

        return $this;
    }

    protected function handleProductUnit(Product $product)
    {
        if ($unit = $this->getFromData('unit')) {
            $unit = Unit::whereLike('name_v', $unit)->first() ?: preferenceRepository()->getDefaultQuantitativeUnit();
            $product->unit()->associate($unit);
        }

        return $this;
    }

    protected function getFromData($properties)
    {
        $result = collect(iterable($properties))->mapWithKeys(function ($property) {
            return [$property => $this->getMatchingData()->get($this->normalizeKey($property))];
        });

        return $result->count() > 1 ? $result->toArray() : $result->first();
    }

    protected function getMatchingData(string $pattern = '')
    {
        $pattern = 'gsx$' . $this->normalizeKey($pattern);

        return $this->data
            ->filter(function ($value, $key) use ($pattern) {
                return starts_with($key, $pattern);
            })
            ->mapWithKeys(function ($value, $key) use ($pattern) {
                return [ltrim(str_after($key, $pattern), '.') => $value->{'$t'}];
            });
    }

    protected function normalizeKey(string $property)
    {
        return str_replace('_', '', strtolower(trim($property)));
    }

    protected function buildEndpointFromShareLink($link)
    {
        preg_match('/\/d\/(.*?)(\/|$)/', $link, $matches);

        $sheetId = isset($matches[1]) ? $matches[1] : $link;

        return $sheetId ? "http://spreadsheets.google.com/feeds/list/{$sheetId}/1/public/values?alt=json" : null;
    }
}
