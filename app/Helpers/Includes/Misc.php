<?php

/**
 * @return array
 */
if (!function_exists('iterable')) {
    function iterable($object)
    {
        return is_array($object) ? $object : [$object];
    }
}

/*
 * @return array
 */
if (!function_exists('nullable')) {
    function nullable($object, $value = 'null')
    {
        return is_null($object) ? $value : $object;
    }
}

if (!function_exists('placeholderImage')) {
    function placeholderImage()
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
