<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReservationResource;
use App\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Retrieve all reservations for given date and time
     * @param $date
     * @param $time
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index($date,$time)
    {
        $reservations = Reservation::
            where('date', $date)
            ->where('reservation_start', '<', $time)
            ->where('reservation_end', '>', $time)
            ->get();

        return ReservationResource::collection($reservations);
    }



    public function store(Request $request)
    {
        $name = $request->input('name');
        $table = $request->input('table');
        $date = $request->input('date');
        $time = $request->input('time');
        $number = $request->input('number');

        $everythingGood = true;

        $reservations = Reservation::all();

        //check if reservation exists
        foreach($reservations as $reservation) {

            if($reservation->date == $date) {
                $everythingGood = false;

            }
        }
//        $reservation = new Reservation;
//        $reservation->name = $name;
//        $reservation->table = $table;
//        $reservation->number = $number;
//        $reservation->date = $date;
//        $reservation->time = $time;
//        $reservation->save();

    }
}
