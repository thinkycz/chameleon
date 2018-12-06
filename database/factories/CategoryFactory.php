<?php

use App\Enums\Locale;
use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => array_fill_keys(Locale::codes(), $faker->word),
        'position' => $faker->numberBetween(0,10)
    ];
});
