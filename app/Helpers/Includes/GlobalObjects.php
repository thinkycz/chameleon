<?php

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
