<?php

namespace App\Traits\Product;

trait ProductHasAttributes
{
    public function getAvailabilityOrDefaultAttribute()
    {
        return $this->availability ?? preferenceRepository()->getDefaultOutOfStockAvailability();
    }

    public function getUnitOrDefaultAttribute()
    {
        return $this->unit ?? preferenceRepository()->getDefaultQuantitativeUnit();
    }

    public function getPublicStockQuantityAttribute()
    {
        if ($this->quantity_in_stock > 100) {
            $qty = '> 100';
        } elseif ($this->quantity_in_stock > 50) {
            $qty = '> 50';
        } elseif ($this->quantity_in_stock > 20) {
            $qty = '> 20';
        } elseif ($this->quantity_in_stock > 10) {
            $qty = '> 10';
        } else {
            $qty = $this->quantity_in_stock;
        }

        return $qty;
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

    public function getFormattedVatrateAttribute()
    {
        return str_replace(',00', '', number_format($this->vatrate, 2, ',', ' '));
    }
}
