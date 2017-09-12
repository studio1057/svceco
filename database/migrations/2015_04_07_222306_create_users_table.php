<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');


			
			$table->integer('group_id')->nullable();
			$table->integer('organization_id')->nullable();

			$table->string('first_name',25);
			$table->string('last_name', 45);

			$table->string('email')->unique();

			$table->string('password');
			$table->boolean('confirmed')->default(0);
            $table->string('confirmation_code')->nullable();
			$table->enum('role', array('volunteer', 'group', 'organization', 'admin'));

            $table->enum('status', array('pending', 'approved', 'denied'));

            $table->boolean('banned')->default(false);

            $table->json('screened');
			$table->rememberToken();
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
		Schema::drop('users');
	}

}
