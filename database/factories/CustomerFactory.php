<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customer;
use App\Models\Employee;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'customerName' => $faker->company,
        'contactLastName' => $faker->lastName,
        'contactFirstName' => $faker->name,
        'phone' => $faker->phoneNumber,
        'addressLine1' => $faker->address,
        'addressLine2' => $faker->secondaryAddress,
        'city' => $faker->city,
        'state' => $faker->state,	
        'postalCode' => $faker->postcode,
        'country' => $faker->country,
        'salesRepEmployeeNumber' => factory(Employee::class),
        'creditLimit' => $faker->randomFloat(2),
    ];
});
