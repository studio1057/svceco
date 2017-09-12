<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('organizations', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('category');
			$table->string('name', 140);
            $table->string('slug', 240);
			$table->string('logo');
			$table->string('email');
            $table->string('state');
            $table->string('city');
            $table->string('zipcode');
			$table->string('address');
			$table->string('phone');
			$table->json('social');
			$table->longText('description');
			$table->string('url', 50);
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
		Schema::drop('organizations');
	}

}
