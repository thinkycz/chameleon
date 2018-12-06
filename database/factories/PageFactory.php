<?php

use App\Models\Page;
use Faker\Generator as Faker;

$factory->define(Page::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'content' => $faker->paragraphs(5, true),
    ];
});
