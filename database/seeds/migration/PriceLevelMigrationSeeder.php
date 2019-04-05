<?php

use App\Models\PriceLevel;

class PriceLevelMigrationSeeder extends BaseMigrationSeeder
{
    protected $pairs = [
        'name'                   => 'name',
        'enabled'                => 'enabled',
        'has_quantity_discounts' => 'has_quantity_discounts',

        /**
         * Default columns
         */
        'id'                     => 'id',
        'created_at'             => 'created_at',
        'updated_at'             => 'updated_at',
    ];

    protected $oldTableName = 'price_levels';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->execute(function ($item) {
            $name = json_decode($item->get('name'));

            $item = $item->merge([
                'name'                   => property_exists($name, 'cs') ? $name->cs : $name->en,
                'enabled'                => $item->get('enabled') ?: false,
                'has_quantity_discounts' => !is_null($item->get('has_quantity_discounts')) ?: false,
            ]);

            PriceLevel::insert($item->toArray());
        });
    }
}
