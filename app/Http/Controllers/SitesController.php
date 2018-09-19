<?php

namespace App\Http\Controllers;


use App\Dish;

class SitesController extends Controller
{
    /**
     * menu subpage
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function menu()
    {
        return view('menu');
    }


    /**
     * reservation subaoge
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reservations()
    {
        return view('reservation');
    }


    /**
     * order online subpage
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function order()
    {
        $dishes = Dish::all();

        return view('order', [
            'dishes' => $dishes,
        ]);
    }
}
