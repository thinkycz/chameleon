<?php

namespace App\Traits\Product;

use App\Models\PriceLevel;

trait ProductHasPrices
{
    public function getPrice(?PriceLevel $priceLevel = null)
    {
        $priceLevel = $priceLevel ?? currentUser()->getPriceLevel();

        $price = $priceLevel ? $this->prices->where('price_level_id', $priceLevel->id)->first() : null;

        return $price ? $price->convertToCurrency(currentCurrency()) : null;
    }

    public function getPriceAttribute()
    {
        return optional($this->getPrice())->price;
    }

    public function getFormattedPriceAttribute()
    {
        return showPriceWithCurrency($this->price, currentCurrency());
    }

    public function getPriceExclVatAttribute()
    {
        return getPriceExclVat($this->price, $this->vatrate, currentCurrency());
    }

    public function getFormattedPriceExclVatAttribute()
    {
        return showPriceWithCurrency($this->price_excl_vat, currentCurrency());
    }

    public function getPurchasableAttribute()
    {
        return currentUser()->is_active && $this->hasPrice() && $this->productIsAvailable() && $this->productIsInStock();
    }
}
