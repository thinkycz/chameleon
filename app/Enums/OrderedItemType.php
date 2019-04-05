<?php

namespace App\Enums;

abstract class OrderedItemType
{
    const COUPON = 'COUPON';
    const PRODUCT = 'PRODUCT';
    const CUSTOM = 'CUSTOM';
    const PAYMENT_METHOD = 'PAYMENT_METHOD';
    const DELIVERY_METHOD = 'DELIVERY_METHOD';

    public static function getTypes()
    {
        return [
            static::COUPON,
            static::PRODUCT,
            static::CUSTOM,
            static::PAYMENT_METHOD,
            static::DELIVERY_METHOD,
        ];
    }
}
