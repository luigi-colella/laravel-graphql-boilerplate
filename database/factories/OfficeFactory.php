<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Office;
use Faker\Generator as Faker;

$factory->define(Office::class, function (Faker $faker) {
    return [
        'city' => $faker->city,
        'phone' => $faker->phoneNumber,
        'addressLine1' => $faker->address,
        'addressLine2' => $faker->secondaryAddress,
        'state' => $faker->state,
        'country' => $faker->country,
        'postalCode' => $faker->postcode,
        'territory' => $faker->country,
    ];
});
