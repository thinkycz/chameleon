<?php

namespace App\Traits\Product;

use App\Models\PriceLevel;
use Illuminate\Database\Eloquent\Builder;

trait ScopeOnlyWithPrice
{
    public function scopeOnlyWithPrice(Builder $query, $onlyWithPrice = false, ?PriceLevel $priceLevel = null)
    {
        return $query->when($onlyWithPrice, function ($query) use ($priceLevel) {
            return $query->whereHas('prices', function ($query) use ($priceLevel) {
                return $query->where('prices.price_level_id', $priceLevel->id ?? null);
            });
        });
    }
}
