<?php

use App\Enums\Locale;
use App\Models\DeliveryMethod;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::create([
            'name' => [
                Locale::ENGLISH    => 'Pay at the store',
                Locale::CZECH      => 'Platba na prodejně',
                Locale::VIETNAMESE => 'Trả tiền tại tiệm'
            ],
            'delivery_method_id' => DeliveryMethod::first()->id
        ]);
    }
}
