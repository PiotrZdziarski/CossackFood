<?php

namespace Tests\Feature;

use App\Dish;
use Tests\TestCase;

class dishTest extends TestCase
{
    /**
     * Test getting all dishes from RestAPI
     */
    public function testGettingAllDishes()
    {
        $dishes = Dish::all();

        $this->get('/api/dishes')
            ->assertSee($dishes);
    }



    /**
     * Test getting one page of dishes from RestAPI
     */
    public function testGettingPageOfDishes()
    {
        $dishCount = Dish::count();

        $this->assertTrue(true);

        for($i = 1; $i <= $dishCount; $i++) {
            $to_skip = $i - 1;
            $dish = Dish::skip($to_skip)->take(1)->first();
            $page = ceil($i / 4);
            $this->get("/api/dishes_page?page=$page")
                ->assertSee($dish);
        }
    }

}
