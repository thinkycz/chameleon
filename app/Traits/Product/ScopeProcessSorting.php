<?php

namespace App\Traits\Product;

use App\Enums\Locale;
use App\Models\PriceLevel;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait ScopeProcessSorting
{
    public function scopeProcessSortingClient(Builder $query, Request $request)
    {
        $locale = Locale::current();

        switch ($request->get('sort')) {
            case 'newest':
                return $query;
            case 'relevance':
                return $query->orderBy('created_at', 'desc');
            case 'price_asc':
                return $query->orderByPrice(currentUser()->getPriceLevel(), 'asc');
            case 'price_desc':
                return $query->orderByPrice(currentUser()->getPriceLevel(), 'desc');
            case 'alphabetically':
                return $query->orderBy("name");
            default:
                return $query->orderBy("name");
        }
    }

    public function scopeOrderByPrice(Builder $query, ?PriceLevel $priceLevel, $direction)
    {
        if ($priceLevel) {
            return $query->selectRaw('products.*')
                ->join('prices', 'products.id', '=', 'prices.product_id')
                ->where('prices.price_level_id', $priceLevel->id)
                ->orderBy('prices.price', $direction);
        }

        return $query;
    }
}
