<?php

namespace App\Http\Controllers;
session_start();

use App\Basket;
use App\BasketProduct;
use App\Dish;
use App\Http\Resources\BasketResource;
use App\Pizza;
use Illuminate\Http\Request;

class BasketProductController extends Controller
{

    /**
     * Return all basket products
     * @return mixed
     */
    public function all_basket_products()
    {
        $all_basket_products = Basket::find($_SESSION['basket_id'])->basket_products;

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
     * Store product to basket
     * @param Request $request
     * @return mixed|string
     */
    public function store(Request $request) {

        $id = $request->input('id');
        $type = $request->input('type');

        switch($type) {
            case 'dish':
                $product = Dish::where('id', $id)->first();
                break;
            case 'pizza':
                $product = Pizza::where('id', $id)->first();
                break;
            default:
                $product = Dish::where('id', $id)->first();
                break;
        }

        if(isset($_SESSION['basket_id'])) {
            $basket_id = $_SESSION['basket_id'];

            //add new product to basket
            return $this->newBasketProduct($type,$product,$basket_id);

        } else {
            $basket = new Basket;
            $basket->save();

            $basket_id = $basket->id;
            $_SESSION['basket_id'] = $basket_id;

            return $this->newBasketProduct($type, $product, $basket_id);
        }
    }



    public function newBasketProduct($type, $product, $basket_id)
    {
        $basket_product = new BasketProduct;
        $basket_product->basket_id = $basket_id;
        $basket_product->price = $product->price;

        switch ($type) {
            case 'dish':
                $basket_product->product = $product->dish;
                break;
            case 'pizza':
                $basket_product->product = $product->pizza;
                break;
            default:
                $basket_product->product = '';
                break;
        }


        if($basket_product->save()) {
            return $this->all_basket_products();
        } else {
            return $error = "Couldn't add product!";
        }
    }
}
