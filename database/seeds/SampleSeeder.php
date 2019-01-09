<?php

use App\Models\Category;
use App\Models\Order;
use Illuminate\Database\Seeder;

class SampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 3)->create();
        factory(Order::class, 3)->create();
    }
}
