<?php

namespace App\Http\Controllers;
session_start();

use App\Basket;
use App\BasketProduct;
use App\Dish;
use App\Http\Resources\BasketResource;
use Illuminate\Http\Request;

class BasketProductController extends Controller
{

    /**
     * Return all basket products
     * @return mixed
     */
    private function all_basket_products()
    {
        $all_basket_products = BasketProduct::where('basket_id', $_SESSION['basket_id'])
            ->get();

        return BasketResource::collection($all_basket_products);
    }



    /**
     * initial basket load when basket_id exists
     * @return mixed
     */
    public function index()
    {
        if(isset($_SESSION['basket_id'])) {
            return $this->all_basket_products();
        } else {
            return null;
        }
    }


    /**
     * Adding dish to basket
     * @param Request $request
     * @return mixed|string
     */
    public function store_dish(Request $request)
    {
        $id = $request->input('id');
        $dish = Dish::where('id', $id)->first();

        if(isset($_SESSION['basket_id'])) {
            $basket_id = $_SESSION['basket_id'];

            //add new product to basket
            $basket_product = new BasketProduct;
            $basket_product->basket_id = $basket_id;
            $basket_product->product = $dish->dish;
            $basket_product->price = $dish->price;


            if($basket_product->save()) {
                return $this->all_basket_products();
            } else {
                return $error = "Couldn't add product!";
            }

        } else {
            $basket = new Basket;
            $basket->save();

            $basket_id = $basket->id;
            $_SESSION['basket_id'] = $basket_id;

            $basket_product = new BasketProduct;
            $basket_product->basket_id = $basket_id;
            $basket_product->product = $dish->dish;
            $basket_product->price = $dish->price;

            if($basket_product->save()) {
                return $this->all_basket_products();
            } else {
                return $error = "Couldn't add product!";
            }
        }
    }
}
