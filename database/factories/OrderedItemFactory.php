<?php

use App\Models\OrderedItem;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(OrderedItem::class, function (Faker $faker) {
    $product = factory(Product::class)->create();
    return [
        'name'             => $product->name,
        'price'            => $product->prices()->first()->price,
        'quantity_ordered' => $faker->numberBetween(2, 7),
        'barcode'          => $product->barcode,
        'catalogue_number' => $product->catalogue_number,
        'product_id'       => $product->id,
    ];
});
