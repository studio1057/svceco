<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('organization_id');
            $table->string('name');
            $table->string('slug');
            $table->timestamp("start_time");
            $table->timestamp("end_time");
            $table->integer("credits");
            $table->longText("description");
            $table->boolean("screening_required");
            $table->boolean("age_requirement");
            $table->integer("org_category");
            $table->integer("category");
            $table->string("phone");
            $table->string("email");
            $table->string("state");
            $table->string("city");
            $table->string("address");
            $table->string("zipcode");
            $table->integer("max_users");
            $table->boolean("featured");

            // events start off as pending
            // when a event starts it's moved to started.
            // when a event is over it is changed to ended
            // when the org is ready the set it to processing.
            // once it's done being processed it is set to completed.
            $table->enum('status', array('started', 'pending', 'ended', 'processing', 'completed', 'canceling', 'canceled'))->default('pending');
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
        Schema::drop('event');
    }
}
