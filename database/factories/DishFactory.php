<?php

use Faker\Generator as Faker;

$factory->define(\App\Dish::class, function (Faker $faker) {
    return [
        'dish' => $faker->text(15),
        'price' => $faker->randomFloat(2, 0 , 40),
        'image' => '',
        'ingredients' => $faker->text(10).','.$faker->text(10).','.$faker->text(10).','.$faker->text(10),
    ];
});
