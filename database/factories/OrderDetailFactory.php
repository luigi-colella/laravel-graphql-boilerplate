<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OrderDetail;
use Faker\Generator as Faker;

$factory->define(OrderDetail::class, function (Faker $faker) {
    return [
        'productCode' => null,
        'quantityOrdered' => $faker->randomNumber(),
        'priceEach' => $faker->randomFloat(2),
        'orderLineNumber' => $faker->randomNumber(),
    ];
});
