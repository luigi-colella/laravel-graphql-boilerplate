<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(OrderDetail::class, function (Faker $faker) {
    return [
        'orderNumber' => factory(Order::class)->create(),
        'productCode' => factory(Product::class)->create(),
        'quantityOrdered' => $faker->randomNumber(),
        'priceEach' => $faker->randomFloat(2),
        'orderLineNumber' => $faker->randomNumber(),
    ];
});
