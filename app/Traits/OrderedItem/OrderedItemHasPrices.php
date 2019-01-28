<?php

namespace App\Traits\OrderedItem;

trait OrderedItemHasPrices
{
    public function getVatrateAttribute()
    {
        return $this->product ? $this->product->vatrate : config('config.default_vat_rate_percentage');
    }

    public function getPriceExclVatAttribute()
    {
        return getPriceExclVat($this->price, $this->vatrate, currentCurrency());
    }

    public function getFormattedPriceExclVatAttribute()
    {
        return showPriceWithCurrency($this->price_excl_vat, currentCurrency());
    }

    public function getTotalPriceExclVatAttribute()
    {
        return $this->quantity_ordered * $this->price_excl_vat;
    }

    public function getFormattedTotalPriceExclVatAttribute()
    {
        return showPriceWithCurrency($this->total_price_excl_vat, currentCurrency());
    }

    public function getTotalPriceAttribute()
    {
        return $this->quantity_ordered * $this->price;
    }

    public function getFormattedTotalPriceAttribute()
    {
        return showPriceWithCurrency($this->total_price, currentCurrency());
    }

    public function getFormattedPriceAttribute()
    {
        return showPriceWithCurrency($this->price, currentCurrency());
    }
}
