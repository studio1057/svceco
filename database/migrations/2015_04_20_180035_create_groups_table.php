<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('groups', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 255);
			$table->integer('type');
            $table->string('state');
            $table->string('city');
            $table->string('zipcode');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
			$table->json('org_rules');
            $table->json('event_rules');
			$table->integer('target_credits');
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
		Schema::drop('groups');
	}

}
