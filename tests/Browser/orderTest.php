<?php

namespace Tests\Browser;

use App\Basket;
use App\BasketProduct;
use App\Dish;
use App\Http\Controllers\BasketProductController;
use App\Http\Controllers\DishController;
use App\Http\Resources\BasketResource;
use App\Http\Resources\DishResource;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class orderTest extends DuskTestCase
{

    private $dishController;
    private $basketProductController;

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
        if($basket == null) {
            Basket::insert(['id' => 1])->save();
        }

        $productFactory = factory(BasketProduct::class)->make();
        $testProduct = new BasketProduct;
        $testProduct->product = $productFactory->product;
        $testProduct->price = $productFactory->price;
        $testProduct->basket_id = $productFactory->basket_id;
        $testProduct->save();

        if(isset($_SESSION['basket_id'])) {
            $previousBasketID = $_SESSION['basket_id'];
        }

        $_SESSION['basket_id'] = 1;
        $basketFromController = $this->basketProductController->all_basket_products();
        $basketCheck = BasketResource::collection(
            Basket::find(1)->basket_products
        );

        $this->assertEquals($basketFromController, $basketCheck);
        $testProduct->delete();

        if(isset($previousBasketID)) {
            $_SESSION['basket_id'] = $previousBasketID;
        }
    }
}
