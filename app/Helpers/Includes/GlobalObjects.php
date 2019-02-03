<?php

use App\Models\Currency;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Session;

if (!function_exists('currentUser')) {
    /**
     * @param bool $optional
     * @return User
     */
    function currentUser($optional = true)
    {
        return $optional ? optional(User::getAuthenticatedUser()) : User::getAuthenticatedUser();
    }
}


if (!function_exists('activeBasket')) {
    /**
     * @return Order
     */
    function activeBasket()
    {
        return User::getActiveBasket();
    }
}

if (!function_exists('currentCurrency')) {
    /**
     * @return Currency
     */
    function currentCurrency()
    {
        if ($currency = Session::has('currency')) {
            return Session::get('currency');
        }

        if ($currency = currentUser()->currency) {
            return $currency;
        }

        return preferenceRepository()->getDefaultCurrency();
    }
}
