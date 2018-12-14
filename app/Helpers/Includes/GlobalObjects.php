<?php

use App\Models\Currency;
use App\Models\User;

/**
 * @return User
 */
if (!function_exists('currentUser')) {
    function currentUser($optional = true)
    {
        return $optional ? optional(User::getAuthenticatedUser()) : User::getAuthenticatedUser();
    }
}

/**
 * @return \App\Models\Basket
 */
if (!function_exists('activeBasket')) {
    function activeBasket()
    {
        return User::getActiveBasket();
    }
}

/**
 * @return \App\Models\Basket
 */
if (!function_exists('currentCurrency')) {
    function currentCurrency()
    {
        // TODO:: implement
        return Currency::whereEnabled(true)->first();
    }
}
