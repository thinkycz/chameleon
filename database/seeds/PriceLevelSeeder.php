<?php

use App\Enums\Locale;
use App\Models\PriceLevel;
use Illuminate\Database\Seeder;

class PriceLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PriceLevel::create([
            'name' => 'Regular',
            'enabled' => true
        ]);
        PriceLevel::create([
            'name' => 'VIP Customers',
            'enabled' => true,
            'has_quantity_discounts' => true
        ]);
    }
}
