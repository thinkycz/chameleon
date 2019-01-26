<?php

return [
    /*
     * Datetime formatting setting
     */
    'datetime_format'             => 'j.n.Y H:i',

    /*
     * Date formatting settings
     */
    'date_format'                 => 'j.n.Y',

    /*
     * Default VAT rate when no VAT is defined
     */
    'default_vat_rate_percentage' => env('DEFAULT_VAT_RATE_PERCENTAGE', 21),

    /*
     * Default pagination for product cards.
     */
    'products_default_pagination' => env('PRODUCTS_DEFAULT_PAGINATION', 48),
];
