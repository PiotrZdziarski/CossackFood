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
    public function index($date, $time)
    {
        $reservations = Reservation::
        where('date', $date)
            ->where('reservation_start', '<=', $time)
            ->where('reservation_end', '>', $time)
            ->get();

        //merge next closest reservation for each table

        //three hours in seconds ( maximum reservation duration)
        $threeHours = 10800;

        $searchingTimeUnix = strtotime($time);

        $closestReservationTime = $searchingTimeUnix + $threeHours;
        $closestReservationTime = date('H:i', $closestReservationTime);

        $reservations = collect($reservations)->push([]);

        //for each table(13)
        for ($i = 1; $i <= 13; $i++) {
            $closestReservation = Reservation::
                where('date', $date)
                ->where('reservation_start', '>', $time)
                ->where('reservation_end', '<', $closestReservationTime)
                ->where('table', $i)
                ->get();

            $lastItem = $reservations->count();

            if ($closestReservation->first()) {

                //calcualate max reservation time
                $closestReservationDuration = strtotime($closestReservation->first()->reservation_start);
                $closestReservationDuration = $closestReservationDuration - $searchingTimeUnix;

                $duration = floor($closestReservationDuration / 1800);

                $reservations[$lastItem - 1] = collect($reservations[$lastItem - 1])
                    ->merge([["t$i" => $duration]]);
            }
        }


        return ReservationResource::collection($reservations);
    }


    /**
     * Store reservation to database
     * @param Request $request
     * @return string
     */
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
        $endReservation = strtotime($timeStart) + $duration;

        //to standard time
        $endReservation = date('H:i:s', $endReservation);


        $reservation = new Reservation;
        $reservation->name = $name;
        $reservation->table = $table;
        $reservation->date = $date;
        $reservation->number = $number;
        $reservation->reservation_start = $timeStart;
        $reservation->reservation_end = $endReservation;

        if ($reservation->save()) {
            return 'Reservation successfully added!';
        } else {
            return 'There was a problem with adding reservation';
        }
    }
}
