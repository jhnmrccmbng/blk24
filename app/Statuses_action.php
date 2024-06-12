<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statuses_action extends Model
{
    protected $fillable = ['sa_cartsorder_id', 'sa_status_id', 'sa_user_id', 'sa_remarks'];

    public function status(){
    	return $this->belongsTo(Status::class, 'sa_status_id');
    }

     public function user(){
    	return $this->belongsTo(User::class, 'sa_user_id');
    }

    public function order(){
    	return $this->hasOne(Cartsorder::class, 'id', 'sa_cartsorder_id');
    }

}
