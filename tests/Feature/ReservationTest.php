<?php

namespace Tests\Feature;

use App\Reservation;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservationTest extends TestCase
{
    /**
     * Test getting reservations from DB
     */
    public function testGettingReservationsFromDB()
    {
        //reservation with that credentials exists in DB
        $exampleDate = '2018-09-13';
        $exampleTime = '13:00';

        //test raw query
        $DBcheck = DB::table('reservations')
            ->where('date', $exampleDate)
            ->where('reservation_start', '<=', $exampleTime)
            ->where('reservation_end', '>', $exampleTime)
            ->get();


        //test if row exists
        if($DBcheck != '[]') {
            $this->get('/api/reservations/2018-09-13/13:00')
                ->assertSee($DBcheck);
        } else {
            DB::table('reservations')->insert([
                'name' => 'testname' ,
                'table' => '1',
                'date' => $exampleDate,
                'number' => '111222333',
                'reservation_start' => $exampleTime,
                'reservation_end' => '14:00'
            ]);
            $this->assertTrue(true, 'Test row added');
        }


        //test eloquent
        $reservations = Reservation::
            where('date', $exampleDate)
            ->where('reservation_start', '<=', $exampleTime)
            ->where('reservation_end', '>', $exampleTime)
            ->get();

        //test RestAPI
        $this->get('/api/reservations/2018-09-13/13:00')
            ->assertSee($reservations);
    }
}
