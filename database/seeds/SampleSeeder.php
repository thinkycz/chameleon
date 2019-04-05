<?php

use App\Models\Category;
use App\Models\Order;
use App\Models\User;
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
        factory(User::class, 3)->create();
    }
}
