<?php

namespace Tests\Feature;

use App\Reservation;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservationTest extends TestCase
{
    private $testname = 'testname';
    private $exampleDate = '2018-09-13';
    private $exampleTime = '13:00';


    /**
     * Test getting reservations from DB
     */
    public function testGettingReservationsFromDB()
    {

        //test raw query
        $DBcheck = DB::table('reservations')
            ->where('date', $this->exampleDate)
            ->where('reservation_start', '<=', $this->exampleTime)
            ->where('reservation_end', '>', $this->exampleTime)
            ->get();

        $DBcheck = collect($DBcheck)->push([['t1' => 2]]);


        //test if row exists
        if($DBcheck != '[[{"t1":2}]]') {
            $this->get('/api/reservations/2018-09-13/13:00')
                ->assertSee($DBcheck);
        } else {
            DB::table('reservations')->insert([
                'name' => $this->testname,
                'table' => '1',
                'date' => $this->exampleDate,
                'number' => '111222333',
                'reservation_start' => $this->exampleTime,
                'reservation_end' => '14:00'
            ]);

            //to test maximum reservation time
            DB::table('reservations')->insert([
                'name' => $this->testname.'2',
                'table' => '1',
                'date' => $this->exampleDate,
                'number' => '111222333',
                'reservation_start' => '14:00',
                'reservation_end' => '15:00'
            ]);
            $this->assertTrue(true, 'Test row added');
        }


        //test eloquent
        $reservations = Reservation::
            where('date', $this->exampleDate)
            ->where('reservation_start', '<=', $this->exampleTime)
            ->where('reservation_end', '>', $this->exampleTime)
            ->get();

        $reservations = collect($reservations)->push([['t1' => 2]]);

        //test RestAPI
        $this->get('/api/reservations/2018-09-13/13:00')
            ->assertSee($reservations);
    }

    /*
     *  Test storing reservation into DB
     */
    public function testStoringReservationToDB()
    {
        $reservation = new Reservation;
        $reservation->name = $this->testname;
        $reservation->table = 1;
        $reservation->date = '2018-09-14';
        $reservation->number =111222333;
        $reservation->reservation_start = $this->exampleTime;
        $reservation->reservation_end = '14:00';


        if($reservation->save()) {
            $this->get('/api/store_reservation')
                ->assertSee('Reservation successfully added!');

            $reservation->delete();
        }
    }
}
