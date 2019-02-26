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
    }
}