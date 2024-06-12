<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartsorders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('co_user_id');
            $table->unsignedInteger('co_status_id');
            $table->unsignedInteger('co_service_id');
            $table->unsignedInteger('co_paymentmethod_id');
            $table->unsignedInteger('co_restaurant_id');
            $table->string('co_totalpayment');
            $table->string('co_receiptnumber');
            $table->string('co_paymonggo_id')->nullable();
            $table->string('co_remarks')->nullable();
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
        Schema::dropIfExists('cartsorders');
    }
}
