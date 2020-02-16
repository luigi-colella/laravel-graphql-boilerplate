<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'orderDate' => $faker->date,
        'requiredDate' => $faker->date,
        'shippedDate' => $faker->date,
        'status' => $faker->word,
        'comments' => $faker->sentence,
        'customerNumber' => $faker->randomNumber(),
    ];
});
