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
            ->where('reservation_start', '<=', $time)
            ->where('reservation_end', '>', $time)
            ->get();

        return ReservationResource::collection($reservations);
    }



    public function store(Request $request)
    {
        $name = $request->input('name');
        $number = $request->input('number');
        $table = $request->input('table');
        $timeStart = $request->input('timeStart');
        $duration = $request->input('duration');
        $date = $request->input('date');


        //hours to seconds
        $duration = $duration * 3600;

        //to unix
        $endReservation =  strtotime($timeStart) + $duration;

        //to standard time
        $endReservation = date('H:i:s', $endReservation);



        $reservation = new Reservation;
        $reservation->name = $name;
        $reservation->table = $table;
        $reservation->date = $date;
        $reservation->number = $number;
        $reservation->reservation_start = $timeStart;
        $reservation->reservation_end = $endReservation;

        if($reservation->save()) {
            return new ReservationResource($reservation);
        } else {
            return 'There was a problem with adding reservation';
        }
    }
}
