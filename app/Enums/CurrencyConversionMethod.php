<?php

namespace App\Enums;

abstract class CurrencyConversionMethod
{
    const DIVIDE_BY_EXCHANGE_RATE = 'DIVIDE_BY_EXCHANGE_RATE';
    const MULTIPLY_BY_EXCHANGE_RATE = 'MULTIPLY_BY_EXCHANGE_RATE';

    public static function getTypes()
    {
        return [
            static::DIVIDE_BY_EXCHANGE_RATE,
            static::MULTIPLY_BY_EXCHANGE_RATE,
        ];
    }
}