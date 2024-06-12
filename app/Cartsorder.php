<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartsorder extends Model
{
    protected $fillable = ['co_service_id', 'co_user_id', 'co_status_id', 'co_paymentmethod_id', 'co_totalpayment', 'co_receiptnumber', 'co_remarks', 'co_restaurant_id', 'co_paymonggo_id'];

    public function placed_at_carts(){
    	return $this->hasMany(Cart::class, 'cart_placeorder_id');
    }

    public function status(){
    	return $this->belongsTo(Status::class, 'co_status_id');
    }

    public function status_actions(){
    	return $this->hasMany(Statuses_action::class, 'sa_cartsorder_id');
    }

    public function user(){
    	return $this->belongsTo(User::class, 'co_user_id');
    }

    public function paymentmode(){
    	return $this->belongsTo(Payment::class, 'co_paymentmethod_id');
    }

    public function service(){
    	return $this->belongsTo(Service::class, 'co_service_id');
    }

    public function restaurant(){
    	return $this->belongsTo(Restaurant::class, 'co_restaurant_id');
    }
}
