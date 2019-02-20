<?php

use Illuminate\Database\Seeder;

class ExistingDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Imported from old databases
         *
         * $this->call(AvailabilitySeeder::class);
         * $this->call(CountrySeeder::class);
         * $this->call(CurrencySeeder::class);
         * $this->call(DeliveryMethodSeeder::class);
         * $this->call(PaymentMethodSeeder::class);
         * $this->call(PageSeeder::class);
         * $this->call(PriceLevelSeeder::class);
         * $this->call(PropertyTypeSeeder::class);
         * $this->call(StatusSeeder::class);
         * $this->call(UnitSeeder::class);
         * $this->call(PermissionsSeeder::class);
         * $this->call(UserSeeder::class);
         */

        $this->call(PreferenceSeeder::class);
        $this->call(SettingSeeder::class);
    }
}
