<?php

use App\Enums\Locale;
use App\Models\DeliveryMethod;
use Illuminate\Database\Seeder;

class DeliveryMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeliveryMethod::create([
            'name'                   => [
                Locale::ENGLISH    => 'Click and Collect',
                Locale::CZECH      => 'Vyzvednout na prodejně',
                Locale::VIETNAMESE => 'Nhận hàng tại tiệm'
            ],
            'needs_shipping_address' => false,
        ]);

    }
}
