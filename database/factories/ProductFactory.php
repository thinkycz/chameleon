<?php

use App\Models\Availability;
use App\Models\Category;
use App\Models\Price;
use App\Models\Product;
use App\Models\Unit;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name'                   => $faker->sentence(3),
        'description'            => $faker->sentence,
        'details'                => $faker->paragraphs(3, true),
        'catalogue_number'       => $faker->randomNumber(9),
        'barcode'                => $faker->randomNumber(8),
        'quantity_in_stock'      => $faker->numberBetween(5, 100),
        'minimum_order_quantity' => $faker->numberBetween(1, 5),
    ];
});

$factory->afterCreating(Product::class, function (Product $product, Faker $faker) {
    $product->availability()->associate(Availability::inRandomOrder()->first());
    $product->unit()->associate(Unit::inRandomOrder()->first());

    factory(Price::class)->create(['product_id' => $product->id]);

    $numberOfImages = $faker->numberBetween(0, 3);
    for ($i = 0; $i < $numberOfImages; $i++) {
        $product->addMediaFromUrl($faker->imageUrl(800, 800))->toMediaCollection('images');
    }

    $categories = Category::inRandomOrder()->take($faker->numberBetween(1, 3))->pluck('id');
    $product->categories()->sync($categories);
    $product->save();
});
