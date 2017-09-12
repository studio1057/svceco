<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInviteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invite', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->nullable();
            $table->integer('organization_id')->nullable();
            $table->string('first_name'); //
            $table->string('last_name'); //
            $table->string('email'); //
            $table->string('invite_code'); //
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
        Schema::drop('invite');
    }
}
