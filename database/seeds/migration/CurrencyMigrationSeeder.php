<?php

use App\Models\Currency;

class CurrencyMigrationSeeder extends BaseMigrationSeeder
{
    protected $pairs = [
        'name'             => 'name',
        'symbol'           => 'symbol',
        'isocode'          => 'isocode',
        'exchange_rate'    => 'exchangeRate',
        'symbol_is_before' => 'symbolIsBefore',
        'enabled'          => 'enabled',

        /**
         * Default columns
         */
        'id'               => 'id',
        'created_at'       => 'created_at',
        'updated_at'       => 'updated_at',
    ];

    protected $oldTableName = 'currencies';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->prepare($array = false);
        $data = $data->map(function ($item) {
            return $item->merge([
                'enabled'          => $item->get('enabled') ?: false,
                'symbol_is_before' => !is_null($item->get('symbol_is_before')) ?: false,
            ]);
        });

        Currency::insert($data->toArray());

    }
}
