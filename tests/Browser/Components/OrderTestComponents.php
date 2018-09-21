<?php

namespace Tests\Browser\Components;


use App\BasketProduct;

class OrderTestComponents
{
    public function createOneBasketProductRecord()
    {
        $productFactory = factory(BasketProduct::class)->make();
        $testProduct = new BasketProduct;
        $testProduct->product = $productFactory->product;
        $testProduct->price = $productFactory->price;
        $testProduct->basket_id = $productFactory->basket_id;
        $testProduct->save();

        $previousBasketID = null;
        if (isset($_SESSION['basket_id'])) {
            $previousBasketID = $_SESSION['basket_id'];
        }
        $_SESSION['basket_id'] = 1;

        return [
            'previousBasketID' => $previousBasketID,
            'testProduct' => $testProduct
        ];
    }
}