<?php

namespace Tests\Feature;

use App\Http\Resources\PizzaResource;
use App\Pizza;
use function MongoDB\BSON\toJSON;
use Tests\TestCase;

class pizzaTest extends TestCase
{
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
