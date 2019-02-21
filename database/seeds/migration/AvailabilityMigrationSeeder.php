<?php

use App\Models\Availability;

class AvailabilityMigrationSeeder extends BaseMigrationSeeder
{
    protected $pairs = [
        'name'             => 'name',
        'description'      => 'description',
        'allow_orders'     => 'allow_orders',
        'products_visible' => 'allow_negative_quantity',
        'products_visible' => 'products_visible',

        /**
         * Default columns
         */
        'id'               => 'id',
        'created_at'       => 'created_at',
        'updated_at'       => 'updated_at',
    ];

    protected $oldTableName = 'availabilities';

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
                'allow_orders'            => $item->get('allow_orders') ?: false,
                'allow_negative_quantity' => !is_null($item->get('allow_negative_quantity')) ?: false,
                'products_visible'        => !is_null($item->get('products_visible')) ?: false,
                'code'                    => str_slug($name->en),
            ]);

            Availability::insert($item->toArray());
        });
    }
}
