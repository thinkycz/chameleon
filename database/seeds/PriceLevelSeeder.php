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
            'name' => [
                Locale::ENGLISH => 'Regular',
                Locale::CZECH => 'Standardní',
                Locale::VIETNAMESE => 'Giá thường',
            ],
            'enabled' => true
        ]);
        PriceLevel::create([
            'name' => [
                Locale::ENGLISH => 'VIP Customers',
                Locale::CZECH => 'VIP zákazníci',
                Locale::VIETNAMESE => 'Khách hàng VIP',
            ],
            'enabled' => true,
            'has_quantity_discounts' => true
        ]);
        PriceLevel::create([
            'name' => [
                Locale::ENGLISH => 'Wholesale',
                Locale::CZECH => 'Velkoobchod',
                Locale::VIETNAMESE => 'Bán buôn',
            ],
        ]);
        PriceLevel::create([
            'name' => [
                Locale::ENGLISH => 'Seasonal',
                Locale::CZECH => 'Sortiment',
                Locale::VIETNAMESE => 'Theo mùa',
            ],
        ]);
        PriceLevel::create([
            'name' => [
                Locale::ENGLISH => 'Clearance',
                Locale::CZECH => 'Výprodej',
                Locale::VIETNAMESE => 'Giải tỏa',
            ],
        ]);
    }
}
