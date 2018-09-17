<?php

namespace App\Http\Controllers;


class SitesController extends Controller
{
    public function menu()
    {
        return view('menu');
    }

    public function reservations()
    {
        return view('reservation');
    }

    public function order()
    {
        return view('order');
    }
}
