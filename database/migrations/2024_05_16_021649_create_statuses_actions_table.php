<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusesActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sa_cartsorder_id');
            $table->unsignedInteger('sa_status_id');
            $table->unsignedInteger('sa_user_id');
            $table->string('sa_remarks')->nullable();
            $table->string('sa_emailsend')->nullable();
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
        Schema::dropIfExists('statuses_actions');
    }
}
