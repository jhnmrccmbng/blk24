<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('restaurant_name');
            $table->string('restaurant_email')->nullable();
            $table->string('restaurant_phone')->nullable();
            $table->string('restaurant_address')->nullable();
            $table->string('restaurant_url')->nullable();
            $table->string('restaurant_openhour')->nullable();
            $table->string('restaurant_closehour')->nullable();
            $table->string('restaurant_days')->nullable();
            $table->string('restaurant_imagepath')->nullable();
            $table->integer('restaurant_category_id')->nullable()->default(1);
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
        Schema::dropIfExists('restaurants');
    }
}
