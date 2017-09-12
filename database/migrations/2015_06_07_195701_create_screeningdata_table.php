<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScreeningdataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screeningdata', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('screening_id');
            $table->integer('user_id');
            $table->integer('organization_id');
            $table->json("data");
            $table->enum('status', array('pending', 'denied', 'accepted'));
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
        Schema::drop('screeningdata');
    }
}
