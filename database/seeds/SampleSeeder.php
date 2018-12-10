<?php

use App\Models\Category;
use App\Models\Order;
use App\Models\Page;
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
        $this->call(UserSeeder::class);
        factory(Category::class, 5)->create();
        factory(Page::class, 5)->create();
        factory(Order::class, 5)->create();
    }
}
