<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
     protected $fillable=['role_name','slug','permissions'];

     public $timestamps = false;

     public function hasAccess(array $permissions){
      	foreach($permissions as $permission){
      		if($this->hasPermission($permission)){
      			return true;
      		}
      	}
      	return false;
      }

      protected function hasPermission(string $permission){
      	$permissions = json_decode($this->permissions, true);
      	return $permissions[$permission]??false;
      }
}
