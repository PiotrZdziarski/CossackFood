<?php

namespace App\Http\Controllers;

use App\Pizza;

class PizzaController extends Controller
{
    public function remove_dots()
    {
        $pizzas = Pizza::all();

        foreach($pizzas as $pizza) {
            $pizza->pizza = str_replace('.', '', $pizza->pizza);
            $pizza->ingredients = str_replace('.', '', $pizza->ingredients);

            $pizza->save();
        }
    }
}
