<?php

use App\Models\DeliveryMethod;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;

class PaymentMethodMigrationSeeder extends BaseMigrationSeeder
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

    protected $oldTableName = 'payment_methods';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->prepare($array = false);
        $data = $data->map(function ($item) {
            $deliveryMethod = DB::connection('old_mysql')
                ->table('delivery_method_payment_method')
                ->where('p_method_id', $item->get('id'))
                ->first();

            return $item->merge([
                'enabled'                  => !is_null($item->get('enabled')) ?: false,
                'price_will_be_calculated' => false,
                'delivery_method_id'       => $deliveryMethod ? $deliveryMethod->d_method_id : DeliveryMethod::first()->id,
            ]);
        });

        PaymentMethod::insert($data->toArray());
    }
}
