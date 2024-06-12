<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory_out extends Model
{
    protected $fillable = ['inventory_id', 'quantity', 'remarks', 'user_id'];
}