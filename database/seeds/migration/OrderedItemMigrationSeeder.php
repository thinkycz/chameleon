<?php

use App\Models\OrderedItem;

class OrderedItemMigrationSeeder extends BaseMigrationSeeder
{
    protected $pairs = [
        'name'             => 'name',
        'description'      => 'details',
        'details'          => 'details',
        'price'            => 'price',
        'vatrate'          => 'vatrate',
        'quantity_ordered' => 'quantityOrdered',
        'barcode'          => 'barcode',
        'catalogue_number' => 'catalogueNumber',
        'type'             => 'type',
        'product_id'       => 'product_id',
        'order_id'         => 'order_id',

        /**
         * Default columns
         */
        'id'               => 'id',
        'created_at'       => 'created_at',
        'updated_at'       => 'updated_at',
    ];

    protected $oldTableName = 'ordered_items';

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
                'quantity_ordered' => $item->get('quantity_ordered') ?: 1,
            ]);
        });

        OrderedItem::insert($data->toArray());
    }
}
