<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public function brand(){

        return $this->belongsTo(Brand::class);

    }

    public function images(){

        return $this->hasMany(Image::class);

    }

    public function orders(){
        return $this->hasMany(OrderProduct::class);
    }

}
