<?php

namespace Tests\Feature;

use App\Pizza;
use Tests\TestCase;

class pizzaTest extends TestCase
{
    /**
     * Test getting all pizzas from RestAPI
     */
    public function testGettingAllPizzas()
    {
        $pizzas = Pizza::all();
        $this->get('/api/pizza')
            ->assertSee($pizzas);
    }



    /**
     * Testing Pizza pages RestAPI
     */
    public function testGettingPagesOfPizzas()
    {
        //get maximum pages of pizza
        $maximumPages = Pizza::count();
        $maximumPages = ceil($maximumPages / 8);

        for($i = 1; $i < $maximumPages; $i++) {
            //take first one pizza for each page
            $pizza_number = $i - 1;
            $pizza = Pizza::skip($pizza_number * 8)->first();

            $response = $this->get("api/pizza_pages?pages=$i");

            $response
                ->assertSee($pizza)
                //check if the response has maximum pages number
                ->assertJsonFragment(['maxPages' => $maximumPages]);
        }
    }
}
