<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'image', 'price', 'active', 'publish_at', 'brand_id'
    ];
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
