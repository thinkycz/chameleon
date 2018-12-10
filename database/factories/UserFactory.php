<?php

use App\Models\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
 */

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name'        => $faker->firstName,
        'last_name'         => $faker->lastName,
        'email'             => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password'          => bcrypt('nulisec789'),
        'remember_token'    => str_random(10),
    ];
});

$factory->afterCreating(User::class, function ($user, Faker $faker) {
    $user->addMediaFromUrl($faker->imageUrl(800, 800, 'technics'))->toMediaCollection('images');
});
