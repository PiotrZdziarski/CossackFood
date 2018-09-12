<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReservationResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReservationController extends Controller
{

    public function store(Request $request)
    {
        $fullname = $request->input('fullname');
        $table = $request->input('table');
        $date = $request->input('date');
        $time = $request->input('time');
        $contact_number = $request->input('contact_number');

        $datetime = $date + $time;

        return $datetime;
    }
}
