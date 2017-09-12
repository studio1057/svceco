<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVolunteersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('volunteers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			//$table->foreign('user_id')->references('id')->on('users');
			$table->date('birthdate');
            $table->string('phone');
			$table->integer('target_credits');
			$table->integer('current_credits');
			$table->integer('type');
			$table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('volunteers', function(Blueprint $table)
		{
			Schema::drop('volunteers');
	
		});
	}

}
