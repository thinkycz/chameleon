<?php

use App\Enums\OrderedItem;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(OrderedItem::class, function (Faker $faker) {
    $product = factory(Product::class)->create();
    return [
        'name'             => $product->name,
        'description'      => $product->description,
        'details'          => $product->details,
        'price'            => $product->prices()->first()->price,
        'quantity_ordered' => $faker->numberBetween(2, 7),
        'barcode'          => $product->barcode,
        'catalogue_number' => $product->catalogue_number,
        'product_id'       => $product->id,
        'options'          => [],
    ];
});
