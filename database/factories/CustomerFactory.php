<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'customerName' => $faker->company,
        'contactLastName' => $faker->lastName,
        'contactFirstName' => $faker->name,
        'phone' => $faker->phoneNumber,
        'addressLine1' => $faker->buildingNumber . ' '  . $faker->streetName,
        'addressLine2' => $faker->secondaryAddress,
        'city' => $faker->city,
        'state' => $faker->state,	
        'postalCode' => $faker->postcode,
        'country' => $faker->country,
        'salesRepEmployeeNumber' => null,
        'creditLimit' => $faker->randomFloat(2),
    ];
});
