<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];

    public function restaurants(){
    	return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }
}
