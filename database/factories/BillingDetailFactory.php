<?php

use App\Models\BillingDetail;
use App\Models\Country;
use Faker\Generator as Faker;

$factory->define(BillingDetail::class, function (Faker $faker) {
    return [
        'company_name' => $faker->company,
        'first_name'   => $faker->firstName,
        'last_name'    => $faker->lastName,
        'city'         => $faker->city,
        'street'       => $faker->address,
        'zipcode'      => $faker->postcode,
        'phone'        => $faker->phoneNumber,
        'vat_id'       => $faker->ean8,
        'company_id'   => $faker->isbn10,
        'country_id'   => Country::whereEnabled(true)->inRandomOrder()->first()->id,
    ];
});
