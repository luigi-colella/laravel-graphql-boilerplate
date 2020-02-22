<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use App\Models\ProductLine;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'productCode' => $faker->word,
        'productName' => $faker->name,
        'productLine' => factory(ProductLine::class)->create(),
        'productScale' => '1:' . $faker->randomDigit,
        'productVendor' => $faker->company,
        'productDescription' => $faker->sentence,
        'quantityInStock' => $faker->randomNumber(),
        'buyPrice' => $faker->randomFloat(2),
        'MSRP' => $faker->randomFloat(2),
    ];
});
