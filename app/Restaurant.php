<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $guarded = ["id"];

    public function categories(){
    	return $this->belongsTo(Category::class, 'restaurant_category_id');
    }

    public function products(){
    	return $this->hasMany(Product::class, 'restaurant_id');
    }
}