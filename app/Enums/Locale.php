<?php

namespace App\Enums;

abstract class Locale
{
    const CZECH = 'cs';
    const ENGLISH = 'en';
    const VIETNAMESE = 'vi';

    public static function all()
    {
        return [
            static::ENGLISH    => 'English',
            static::CZECH      => 'Czech',
            static::VIETNAMESE => 'Vietnamese'
        ];
    }

    public static function codes()
    {
        return array_keys(static::all());
    }

    public static function values()
    {
        return array_values(static::all());
    }
}