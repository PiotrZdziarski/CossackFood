<?php

use Faker\Generator as Faker;

$factory->define(\App\Pizza::class, function (Faker $faker) {
    return [
        'pizza' => $faker->text(15),
        'ingredients' => $faker->text(10).','.$faker->text(10).','.$faker->text(10).','.$faker->text(10).',',
        'price' => $faker->randomFloat(2,0,40)
    ];

});
