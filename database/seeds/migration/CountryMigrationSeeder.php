<?php

use App\Models\Country;

class CountryMigrationSeeder extends BaseMigrationSeeder
{
    protected $pairs = [
        'name'       => 'name',
        'isocode2'   => 'isocode2',
        'isocode3'   => 'isocode3',
        'enabled'    => 'enabled',

        /**
         * Default columns
         */
        'id'         => 'id',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
    ];

    protected $oldTableName = 'countries';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->execute(function ($item) {
            $item = $item->merge([
                'enabled' => $item->get('enabled') ?: false,
            ]);

            Country::insert($item->toArray());
        });

    }
}
