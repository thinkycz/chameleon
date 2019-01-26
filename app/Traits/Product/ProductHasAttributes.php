<?php

namespace App\Traits\Product;

trait ProductHasAttributes
{
    public function getAvailabilityOrDefaultAttribute()
    {
        return $this->availability ?? preferenceRepository()->getDefaultOutOfStockAvailability();
    }
}
