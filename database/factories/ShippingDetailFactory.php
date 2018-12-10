<?php

use App\Models\ShippingDetail;
use Faker\Generator as Faker;

$factory->define(ShippingDetail::class, function (Faker $faker) {
    return [
        'company_name' => $faker->company,
        'first_name'   => $faker->firstName,
        'last_name'    => $faker->lastName,
        'city'         => $faker->city,
        'street'       => $faker->address,
        'zipcode'      => $faker->postcode,
        'phone'        => $faker->phoneNumber,
        'country_id'   => Country::whereEnabled(true)->inRandomOrder()->first()->id,
    ];
});
