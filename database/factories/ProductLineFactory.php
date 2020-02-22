<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductLine;
use Faker\Generator as Faker;

$factory->define(ProductLine::class, function (Faker $faker) {
    return [
        'productLine' => $faker->word,
        'textDescription' => $faker->text,
        'htmlDescription' => $faker->randomHtml(),
    ];
});
