<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function cartorders(){
    	return $this->hasMany(Cartsorder::class, 'co_status_id');
    }
}
