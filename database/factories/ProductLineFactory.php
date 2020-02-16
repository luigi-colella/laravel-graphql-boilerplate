<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductLine;
use Faker\Generator as Faker;

$factory->define(ProductLine::class, function (Faker $faker) {
    return [
        'textDescription' => $faker->text,
        'htmlDescription' => $faker->randomHtml(),
    ];
});
