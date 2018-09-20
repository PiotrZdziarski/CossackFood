<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    public $timestamps = false;

    public function basket_products()
    {
        return $this->hasMany('App\BasketProduct');
    }
}
