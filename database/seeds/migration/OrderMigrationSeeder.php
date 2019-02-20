<?php

use App\Models\Order;

class OrderMigrationSeeder extends BaseMigrationSeeder
{
    protected $pairs = [
        'order_number'       => 'order_number',
        'placed_at'          => 'created_at',
        'invoice_number'     => 'invoice_number',
        'variable_symbol'    => 'variable_symbol',
        'tax_date'           => 'tax_date',
        'due_date'           => 'due_date',
        'email'              => 'email',
        'phone'              => '',
        'notes'              => 'notes',
        'customer_note'      => 'customer_note',
        'status_id'          => 'status_id',
        'delivery_method_id' => 'delivery_method_id',
        'payment_method_id'  => 'payment_method_id',
        'shipping_detail_id' => 'shipping_information_id',
        'billing_detail_id'  => 'billing_information_id',
        'user_id'            => 'user_id',

        /**
         * Default columns
         */
        'id'                 => 'id',
        'created_at'         => 'created_at',
        'updated_at'         => 'updated_at',
    ];

    protected $oldTableName = 'orders';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::insert($this->prepare());
    }
}
