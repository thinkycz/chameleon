<?php

namespace App\Traits\User;

trait UserHasGetters
{
    public static function getActiveBasket()
    {
        return auth()->check() ? static::getAuthenticatedUser()->getBasket() : null;
    }

    public static function getAuthenticatedUser()
    {
        return auth()->user();
    }

    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getIsActiveAttribute()
    {
        return !!$this->activated_at;
    }

    public function getBasket()
    {
        return $this->allOrders()
            ->with('orderedItems.product')
            ->whereNull('placed_at')
            ->firstOrCreate([]);
    }

    public function getPriceLevel()
    {
        return $this->priceLevel ?? preferenceRepository()->getDefaultPriceLevel() ?? PriceLevel::first();
    }
}
