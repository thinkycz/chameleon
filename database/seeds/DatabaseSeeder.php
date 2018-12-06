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
        $this->call(UnitSeeder::class);
    }
}
