<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use App\Models\PropertyType;
use Spatie\Tags\Tag;

class ProductRepository
{
    public function getProductsForCategory(Category $category)
    {
        $products = Product::with('media', 'tags', 'properties', 'categories', 'prices')
            ->whereEnabled(true)
            ->processCategoryClient($category)
            ->processPriceRangeClient(request());

        return $products;
    }

    public function filterAndGetProducts($products)
    {
        return $products->processTagsClient(request())
            ->onlyAvailable(request()->get('in_stock_only'))
            ->onlyWithPrice(request()->get('only_with_price'), currentUser()->priceLevel)
            ->processPropertiesClient(request())
            ->processSortingClient(request())
            ->paginate(request()->get('per_page') ?: config('config.products_default_pagination'));
    }

    public function getPropertiesRelatedToProducts($products)
    {
        $base = $products->toBase();

        $propertyTypes = $base->select('property_types.*')
            ->join('properties', 'products.id', '=', 'properties.product_id')
            ->join('property_types', function ($q) {
                $q->on('properties.property_type_id', '=', 'property_types.id')
                    ->where('is_sortable', true);
            })
            ->groupBy('property_types.id')
            ->get()
            ->toArray();

        return PropertyType::hydrate($propertyTypes)->load('properties.propertyValue');
    }

    public function getTagsRelatedToProducts($products)
    {
        $base = $products->toBase();

        $tags = $base
            ->select('tags.*')
            ->join('taggables', function ($q) {
                $q->on('products.id', '=', 'taggables.taggable_id')
                    ->where('taggable_type', Product::class);
            })
            ->join('tags', 'taggables.tag_id', '=', 'tags.id')
            ->groupBy('tags.id')
            ->get()
            ->toArray();

        return Tag::hydrate($tags);
    }
}
