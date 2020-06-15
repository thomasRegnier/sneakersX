<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    //
    public function order(){

        return $this->belongsTo(Order::class);

    }


    //
    public function productsInOrder(){

        return $this->belongsTo(Product::class, 'product_id');

    }
}
