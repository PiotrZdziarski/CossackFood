<?php

namespace App\Http\Controllers;

use App\Dish;
use Illuminate\Http\Request;

class DishController extends Controller
{


    /**
     * Prepare rows from seeder
     */
    public function prepare_rows_from_seeder()
    {
        $dishes = Dish::all();
        foreach ($dishes as $dish) {
            $dish->dish = str_replace('.', '', $dish->dish);
            $dish->ingredients = str_replace('.', '', $dish->ingredients);
            $dish->ingredients = str_replace(',', ', ', $dish->ingredients);
            //$dish->ingredients = substr_replace($dish->ingredients, "", -1);
            $dish->save();
        }
    }
}
