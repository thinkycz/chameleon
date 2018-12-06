<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AvailabilitySeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(DeliveryMethodSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(PriceLevelSeeder::class);
        $this->call(PropertyTypeSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(UnitSeeder::class);
    }
}
