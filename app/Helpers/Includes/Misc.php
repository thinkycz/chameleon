<?php

if (!function_exists('getPlaceholderImg')) {
    function getPlaceholderImg()
    {
        return asset('images/no_image.jpg');
    }
}

if (!function_exists('getCurrentView')) {
    function getCurrentView($default)
    {
        return request()->get('current', old('current', $default));
    }
}

if (!function_exists('selectedIf')) {
    function selectedIf($boolean, $text = 'selected')
    {
        return $boolean ? $text : '';
    }
}

/**
 * TODO:: Replace when Currency is properly implemented
 */
if (!function_exists('showPriceWithCurrency')) {
    function showPriceWithCurrency($price, $currency = null, $noPrice = null)
    {
        return "{$price} Kč";
    }
}
