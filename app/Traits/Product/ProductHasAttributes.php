<?php

namespace App\Traits\Product;

trait ProductHasAttributes
{
    public function getAvailabilityOrDefaultAttribute()
    {
        return $this->availability ?? preferenceRepository()->getDefaultOutOfStockAvailability();
    }

    public function hasCategory()
    {
        return $this->categories()->count();
    }

    public function getFirstCategory()
    {
        return $this->categories->first();
    }

    public function getShowPathAttribute()
    {
        return route('products.show', $this);
    }
}
