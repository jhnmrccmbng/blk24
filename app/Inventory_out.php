<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory_out extends Model
{
    protected $fillable = ['inventory_id', 'quantity', 'remarks', 'user_id'];

    public function item(){
    	return $this->belongsTo(InventoryIn::class, 'inventory_id');
    }

    public function user(){
    	return $this->belongsTo(User::class, 'user_id');
    }
}