<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_ins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('inventory_itemID');
            $table->string('inventory_name');
            $table->string('inventory_desc');
            $table->unsignedInteger('inventory_categoryID');
            $table->unsignedInteger('inventory_statusID');
            $table->string('inventory_purchasedate');
            $table->string('inventory_expirydate');
            $table->string('inventory_quantity');
            $table->string('inventory_unitprice');
            $table->string('inventory_value')->nullable();
            $table->string('inventory_remarks')->nullable();
            $table->unsignedInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_ins');
    }
}
