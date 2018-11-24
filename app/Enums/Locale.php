<?php

namespace App\Enums;

abstract class Locale
{
    const CZECH = 'cs';
    const ENGLISH = 'en';
    const VIETNAMESE = 'vi';

    public static function getAllowedLocales()
    {
        return [
            static::ENGLISH    => 'English',
            static::CZECH      => 'Czech',
            static::VIETNAMESE => 'Vietnamese'
        ];
    }
}