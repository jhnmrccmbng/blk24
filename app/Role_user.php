<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_user extends Model
{
    protected $fillable = ['user_id', 'role_id'];

    public $timestamps = false;

    public function roles(){
    	return $this->belongsTo(Role::class, 'role_id');
    }
}
