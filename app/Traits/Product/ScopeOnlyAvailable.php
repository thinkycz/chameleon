<?php

namespace App\Traits\Product;

use Illuminate\Database\Eloquent\Builder;

trait ScopeOnlyAvailable
{
    public function scopeOnlyAvailable(Builder $query, $onlyAvailable = false)
    {
        return $query->when($onlyAvailable, function ($query) {
            return $query->whereHas('availability', function (Builder $query) {
                return $query->where('allow_orders', true)->where(function (Builder $query) {
                    return $query->where('allow_negative_quantity', true)->orWhere('products.quantity_in_stock', '>', 0);
                });
            });
        });
    }
}
