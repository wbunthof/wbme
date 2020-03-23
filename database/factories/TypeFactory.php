<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Type;
use Faker\Generator as Faker;

$factory->define(Type::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'brand' => $faker->company,
        'specifications' => json_encode([   'Color' => $faker->colorName,
                                            'Power' => $faker->numberBetween(20, 5000) . ' Watt']),
    ];
});
