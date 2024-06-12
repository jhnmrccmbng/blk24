<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = ['id'];

    public function products(){
    	return $this->belongsTo(Product::class, 'cart_product_id');
    }
}
