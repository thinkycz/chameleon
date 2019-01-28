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

if (!function_exists('booleanToString')) {
    function booleanToString($boolean, $true = 'true', $false = 'false')
    {
        return $boolean ? $true : $false;
    }
}

if (!function_exists('stringToBoolean')) {
    function stringToBoolean($string)
    {
        return is_bool($string) ? $string : 'true' == $string;
    }
}

/*
 * @return float
 */
if (!function_exists('normalizeNumber')) {
    function normalizeNumber($val)
    {
        $val = str_replace(',', '.', $val);
        $val = preg_replace('/\.(?=.*\.)/', '', $val);

        return floatval($val);
    }
}

/*
 * @return float
 */
if (!function_exists('novaResourceAction')) {
    function novaResourceAction($resourceName, $resource)
    {
        $nova = config('nova.path');

        return "${nova}/${resourceName}/${resource}";
    }
}
