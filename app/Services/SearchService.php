<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchService
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var int
     */
    private $take = 1000;

    /**
     * @var int
     */
    private $cacheMin = 5;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function take($take)
    {
        $this->take = $take;

        return $this;
    }

    public function fetch()
    {
        return cache()->remember($this->getCacheKey(), $this->cacheMin, function () {
            return $this->fetchProducts();
        });
    }

    private function fetchProducts()
    {
        return Product::search($this->request->get('query'))
            ->take($this->take)->get()
            ->when($this->request->get('hide_without_prices'), function ($products) {
                return $products->filter(function (Product $product) {
                    return $product->hasPrice();
                });
            })
            ->when($this->request->get('in_stock_only'), function ($products) {
                return $products->filter(function (Product $product) {
                    return $product->productIsAvailable() && $product->productIsInStock();
                });
            })
            ->when($this->request->get('sort') == 'alphabetically', function ($products) {
                return $products->sortBy('name');
            })
            ->when($this->request->get('sort') == 'price_asc', function ($products) {
                return $products->sort(function (Product $p1, Product $p2) {
                    return $p1->price < $p2->price ? -1 : 1;
                });
            })
            ->when($this->request->get('sort') == 'price_desc', function ($products) {
                return $products->sort(function (Product $p1, Product $p2) {
                    return $p1->price > $p2->price ? -1 : 1;
                });
            });
    }

    private function getCacheKey()
    {
        return collect($this->request->query->all())
            ->filter(function ($value, $key) {
                return !(str_is('page', $key) || str_is('per_page', $key));
            })
            ->map(function ($value, $key) {
                return "$key:$value";
            })
            ->implode('|');
    }
}
