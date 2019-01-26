<?php

namespace App\Traits\Product;

trait ProductHasEligibilities
{
    public function hasPrice(PriceLevel $priceLevel = null)
    {
        return $this->getPrice($priceLevel) ? true : false;
    }

    public function productIsAvailable()
    {
        return $this->availability_or_default->allow_orders;
    }

    public function productIsInStock()
    {
        return $this->availability_or_default->allow_negative_quantity || $this->store->allow_residual_quantity_orders ? true : $this->quantity_in_stock >= $this->minimum_order_quantity;
    }
}
