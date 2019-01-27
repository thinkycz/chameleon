<?php

namespace App\Traits\Product;

use App\Exceptions\Product\NotEligibleToAddToBasket;
use App\Models\PriceLevel;
use App\Services\EligibilityResult;

trait ProductHasEligibilities
{
    public function checkEligibility($quantity, $options = [])
    {
        try {
            $this->isEligibleToAddToBasket($quantity, $options);
        } catch (NotEligibleToAddToBasket $exception) {
            return new EligibilityResult(false, $exception->getMessage());
        }

        return new EligibilityResult(true);
    }

    public function isEligibleToAddToBasket($quantity, $options)
    {
        if (!$this->hasPrice()) {
            throw new NotEligibleToAddToBasket(__('eligibilities.no_price_defined'));
        } elseif (!$this->productIsAvailable()) {
            throw new NotEligibleToAddToBasket(__('eligibilities.not_available'));
        } elseif (!$this->productIsInStock()) {
            throw new NotEligibleToAddToBasket(__('eligibilities.out_of_stock'));
        } elseif (!$this->desiredQuantityIsInStock($quantity) && !settingsRepository()->get('shopping_policy', 'allow_residual_qty_orders')) {
            throw new NotEligibleToAddToBasket(__('eligibilities.desired_qty_not_available'));
        } elseif (!$this->desiredQuantityIsInStock($quantity) && settingsRepository()->get('shopping_policy', 'allow_residual_qty_orders')) {
            throw new NotEligibleToAddToBasket(__('eligibilities.only_count_unit_are_available', ['count' => $this->quantity_in_stock, 'unit' => $this->unit_or_default->abbr]));
        } elseif (!$this->userOrdersAtLeastMOQ($quantity)) {
            throw new NotEligibleToAddToBasket(__('eligibilities.moq_not_reached'));
        } elseif (!$this->userOrdersMOQMultiplier($quantity)) {
            throw new NotEligibleToAddToBasket(__('eligibilities.moq_multiplies_only'));
        } elseif (!$this->hasAllOptions($options)) {
            throw new NotEligibleToAddToBasket(__('eligibilities.options_missing'));
        } else {
            return true;
        }
    }

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
        return $this->availability_or_default->allow_negative_quantity ? true : $this->quantity_in_stock >= $this->minimum_order_quantity;
    }

    public function desiredQuantityIsInStock($quantity = 1)
    {
        return $this->availability_or_default->allow_negative_quantity ? true : $this->quantity_in_stock >= $quantity;
    }

    public function userOrdersAtLeastMOQ($quantity = 1)
    {
        $isResidual = settingsRepository()->get('shopping_policy', 'allow_residual_qty_orders') && $this->quantity_in_stock < $this->minimum_order_quantity;

        return $isResidual ? $quantity == $this->quantity_in_stock : $quantity >= $this->minimum_order_quantity;
    }

    public function userOrdersMOQMultiplier($quantity)
    {
        return $this->multiply_of_moq_only && $quantity > $this->minimum_order_quantity ? $quantity % $this->minimum_order_quantity == 0 : true;
    }

    public function hasAllOptions($options)
    {
        return $options ? $this->options->unique('product_type_id')->count() == count($options) : true;
    }
}
