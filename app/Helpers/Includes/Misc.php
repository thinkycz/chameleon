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
