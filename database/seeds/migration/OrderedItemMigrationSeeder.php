<?php

use App\Models\Order;
use App\Models\OrderedItem;
use App\Models\Product;

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
        $this->execute(function ($item) {
            if (Order::find($item->get('order_id'))) {

                if ($item->get('type') == 'PRODUCT') {
                    if (!(Product::find($item->get('product_id')))) {
                        $item = $item->merge([
                            'product_id' => null,
                        ]);
                    }
                }

                $item = $item->merge([
                    'quantity_ordered' => $item->get('quantity_ordered') ?: 1,
                ]);

                OrderedItem::insert($item->toArray());
            }
        });
    }
}
