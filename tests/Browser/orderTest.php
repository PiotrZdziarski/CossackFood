<?php

namespace Tests\Browser;

use App\Basket;
use App\Dish;
use App\Http\Controllers\BasketProductController;
use App\Http\Controllers\DishController;
use App\Http\Resources\BasketResource;
use App\Http\Resources\DishResource;
use Tests\Browser\Components\OrderTestComponents;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class orderTest extends DuskTestCase
{

    private $dishController;
    private $basketProductController;
    private $orderTestComponents;

    /**
     * orderTest constructor, declare dishController.
     * @param null|string $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        $this->dishController = new DishController();
        $this->basketProductController = new BasketProductController();
        $this->orderTestComponents = new OrderTestComponents();

        parent::__construct($name, $data, $dataName);

    }


    /**
     * test Order Page
     * @throws \Throwable
     */
    public function testOrderSubpage()
    {
        $dishes = DishResource::collection(Dish::all());
        $this->assertEquals($this->dishController->index(), $dishes);

        $this->browse(function (Browser $browser) {
            $browser->visit('/order')
                ->assertSee($this->dishController->index()->first()->dish)
                ->assertSee('Summary');
        });
    }


    /**
     * test BasketProductController all_basket_products() method
     * @throws \Exception
     */
    public function testRetrievingBasketProducts()
    {
        $basket = Basket::find(1);
        if ($basket == null) {
            Basket::insert(['id' => 1])->save();
        }

        $testProduct =  $this->orderTestComponents->createOneBasketProductRecord();

        $previousBasketID = $testProduct['previousBasketID'];
        $testProduct = $testProduct['testProduct'];

        $basketFromController = $this->basketProductController->all_basket_products();
        $basketCheck = BasketResource::collection(
            Basket::find(1)->basket_products
        );

        $this->assertEquals($basketFromController, $basketCheck);
        $testProduct->delete();

        if (isset($previousBasketID)) {
            $_SESSION['basket_id'] = $previousBasketID;
        }
    }



    public function testDeletingSingleProduct()
    {
        $testProduct =  $this->orderTestComponents->createOneBasketProductRecord();

        $previousBasketID = $testProduct['previousBasketID'];
        $testProduct = $testProduct['testProduct'];

        $data = [
            'id' => $testProduct->id
        ];
        $response = $this->json('POST', '/api/basket_delete', $data);
        $response->assertStatus(200);

        if (isset($previousBasketID)) {
            $_SESSION['basket_id'] = $previousBasketID;
        }
    }

    /**
     * Test deleting all products
     */
    public function testDeletingAllProducts()
    {
        $testProduct =  $this->orderTestComponents->createOneBasketProductRecord();

        $previousBasketID = $testProduct['previousBasketID'];
        $testProduct = $testProduct['testProduct'];

        $this->assertDatabaseHas('basket_products', $testProduct->toArray());
        $this->basketProductController->delete_all();
        $this->assertDatabaseMissing('basket_products', $testProduct->toArray());

        if (isset($previousBasketID)) {
            $_SESSION['basket_id'] = $previousBasketID;
        }
    }
}
