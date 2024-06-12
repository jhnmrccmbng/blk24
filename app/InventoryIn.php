<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryIn extends Model
{
    protected $fillable = ['inventory_itemID', 'inventory_name', 'inventory_desc', 'inventory_categoryID', 'inventory_statusID', 'inventory_purchasedate', 'inventory_expirydate', 'inventory_quantity', 'inventory_unitprice', 'inventory_value', 'inventory_remarks', 'user_id'];

    public function categoryInventory(){
    	return $this->belongsTo(Inventory_category::class, 'inventory_categoryID');
    }

    public function statusInventory(){
    	return $this->belongsTo(Status::class, 'inventory_statusID');
    }
}
