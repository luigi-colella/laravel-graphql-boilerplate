<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'lastName' => $faker->lastName,
        'firstName' => $faker->firstName,
        'extension' => $faker->word,
        'email' => $faker->email,
        'officeCode' => $faker->word,
        'reportsTo' => null,
        'jobTitle' => $faker->jobTitle,
    ];
});
