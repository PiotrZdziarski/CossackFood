<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReservationResource;
use App\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Retrieve all reservations for given date and time and add table with available reservation time
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

        //add index that contains max reservation time if needed
        $reservations = collect($reservations)->push([]);

        //for each table(13)
        for ($i = 1; $i <= 13; $i++) {
            $closestReservation = Reservation::
            where('date', $date)
                ->where('reservation_start', '>', $time)
                ->where('reservation_start', '<', $closestReservationTime)
                ->where('table', $i)
                ->get();

            $lastItem = $reservations->count();

            if ($closestReservation->first()) {

                //calculate max reservation time
                $closestReservationDuration = strtotime($closestReservation->first()->reservation_start);
                $closestReservationDuration = $closestReservationDuration - $searchingTimeUnix;


                //available time 1 - 30min, 2 - 60min, ...., 6 - 3h
                $leftTimeToReservation = floor($closestReservationDuration / 1800);

                //merge it boi
                $reservations[$lastItem - 1] = collect($reservations[$lastItem - 1])
                    ->merge([["t$i" => $leftTimeToReservation]]);
            }

            //if restaurant is closing soon
            else if($searchingTimeUnix > strtotime('18:00')) {
                $restarationCloseTime = strtotime('21:00');


                $closestReservationDuration = $restarationCloseTime - $searchingTimeUnix;


                //available time 1 - 30min, 2 - 60min, ...., 6 - 3h
                $leftTime = floor($closestReservationDuration / 1800);


                //check if $leftTimeToReservation isnt above 18:00 or just if it isnt set
                    $reservations[$lastItem - 1] = collect($reservations[$lastItem - 1])
                        ->merge([["t$i" => $leftTime]]);
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
