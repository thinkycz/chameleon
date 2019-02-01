<?php

use App\Models\Currency;
use App\Models\User;
use Illuminate\Support\Facades\Session;

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
 * @return \App\Models\Currency
 */
if (!function_exists('currentCurrency')) {
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
