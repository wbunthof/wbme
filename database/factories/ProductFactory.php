<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\Type;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'serialnumber' => $faker->company . '_' . $faker->ean8,
        'buyed_at' => $faker->dateTimeBetween('-2 years', 'now'),
        'type_id' => factory(Type::class)
    ];
});
