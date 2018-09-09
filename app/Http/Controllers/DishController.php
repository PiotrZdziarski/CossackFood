<?php

namespace App\Http\Controllers;

use App\Dish;
use App\Http\Resources\DishResource;

class DishController extends Controller
{
    /**
     * Retrieve all dishes
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $dishes = Dish::all();
        return DishResource::collection($dishes);
    }



    /**
     * Return number of pages with dishes
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function page()
    {
        $dishes = Dish::paginate(4);
        return DishResource::collection($dishes);
    }



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
