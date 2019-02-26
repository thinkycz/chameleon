<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class Diff20190226 extends Seeder
{
    public function run()
    {
        Setting::updateOrCreate(['code' => 'exchange_rate_multiply'], [
            'schema' => [
                'type'       => 'object',
                'required'   => ['value'],
                'properties' => [
                    'value' => ['type' => 'boolean'],
                ],
            ],
            'data'   => [
                'value' => false,
            ],
        ]);

        Setting::updateOrCreate(['code' => 'homepage'], [
            'schema' => [
                'type'       => 'object',
                'required'   => [],
                'properties' => [
                    'banner_heading'     => ['type' => 'string'],
                    'banner_subheading'  => ['type' => 'string'],
                    'banner_action_link' => ['type' => 'string'],
                    'banner_action_text' => ['type' => 'string'],
                ],
            ],
            'data'   => [
                'banner_heading'     => 'Placing your order with us is easy.',
                'banner_subheading'  => 'You can browse products through categories, and you can also use the search bar to look for products using barcodes and SKUs. When you find the goods you need, add them to your basket and complete the checkout process to place your order',
                'banner_action_text' => 'Shop Now',
                'banner_action_link' => '/categories',
            ],
        ]);
    }
}