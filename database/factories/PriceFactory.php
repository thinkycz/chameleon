<?php

use App\Models\Price;
use App\Models\PriceLevel;
use Faker\Generator as Faker;

$factory->define(Price::class, function (Faker $faker) {
    return [
        'price'          => $faker->numberBetween(100, 1000),
        'old_price'      => $faker->numberBetween(100, 1000),
        'price_level_id' => PriceLevel::first()->id,
    ];
});
