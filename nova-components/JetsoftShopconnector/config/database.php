<?php

return [
    'shopconnector' => [
        'driver' => 'sqlsrv',
        'host' => env('SHOPCONNECTOR_HOST', ''),
        'port' => env('SHOPCONNECTOR_PORT', ''),
        'database' => env('SHOPCONNECTOR_DATABASE', ''),
        'username' => env('SHOPCONNECTOR_USERNAME', ''),
        'password' => env('SHOPCONNECTOR_PASSWORD', ''),
        'charset' => 'utf8',
        'prefix' => '',
        'options' => [
            PDO::DBLIB_ATTR_STRINGIFY_UNIQUEIDENTIFIER => true
        ]
    ]
];
