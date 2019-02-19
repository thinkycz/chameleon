<?php

namespace App\Enums;

abstract class Locale
{
    const CZECH = 'cs';
    const ENGLISH = 'en';

    public static function all()
    {
        return [
            static::ENGLISH => trans('global.locales.en'),
            static::CZECH   => trans('global.locales.cs'),
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

    public static function current()
    {
        return session('lang') ?? static::app();
    }

    public static function app()
    {
        return config('app.locale', static::fallback());
    }

    public static function fallback()
    {
        return config('app.fallback_locale', static::ENGLISH);
    }
}
