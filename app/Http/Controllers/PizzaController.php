<?php

namespace App\Http\Controllers;

use App\Http\Resources\PizzaResource;
use App\Pizza;
use Illuminate\Http\Request;

class PizzaController extends Controller
{

    /**
     * Retrieving all pizzas from database
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $pizzas = Pizza::all();

        return PizzaResource::collection($pizzas);
    }



    /**
     * Retrieving number of pages
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function pages(Request $request)
    {
        $pages = $request->input('pages');
        $pizzas = Pizza::take((int)$pages * 8)->get();

        $maximumPages = Pizza::count();
        $maximumPages = ceil($maximumPages / 8);

        $pizzas = collect($pizzas)->put('maxPages', array('maxPages' => $maximumPages));

        return PizzaResource::collection($pizzas);
    }



    /**
     * Removing dots inserted by factory Faker
     */
    public function remove_dots()
    {
        $pizzas = Pizza::all();


        foreach ($pizzas as $pizza) {
            $pizza->pizza = str_replace('.', '', $pizza->pizza);
            $pizza->ingredients = str_replace('.', '', $pizza->ingredients);

            $pizza->save();
        }


    }
}
