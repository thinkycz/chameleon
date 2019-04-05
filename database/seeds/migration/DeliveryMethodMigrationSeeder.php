<?php

use App\Models\DeliveryMethod;

class DeliveryMethodMigrationSeeder extends BaseMigrationSeeder
{
    protected $pairs = [
        'name'                 => 'name',
        'minimal_order_amount' => 'minimalOrderAmount',
        'price'                => 'price',
        'enabled'              => 'enabled',

        /**
         * Default columns
         */
        'id'                   => 'id',
        'created_at'           => 'created_at',
        'updated_at'           => 'updated_at',
    ];

    protected $oldTableName = 'delivery_methods';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->execute(function ($item) {
            $item = $item->merge([
                'enabled'                  => !is_null($item->get('enabled')) ?: false,
                'needs_shipping_address'   => true,
                'price_will_be_calculated' => false,
            ]);

            DeliveryMethod::insert($item->toArray());
        });
    }
}
