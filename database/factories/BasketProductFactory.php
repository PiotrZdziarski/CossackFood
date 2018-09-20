<?php

use Faker\Generator as Faker;

$factory->define(\App\BasketProduct::class, function (Faker $faker) {
    return [
        'product' => $faker->text(10),
        'price' => $faker->randomFloat(2, 0 , 40),
        'basket_id' => 1
    ];
});
