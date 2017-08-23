<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            //is string as we may want multi owners in a list e.g."1342,1314,1415"
            $table->json('preferences');
            $table->string('title');
            $table->longtext('description');
            $table->integer('venue');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->dateTime('rsvp_time');
            $table->integer('max_guests');
            $table->boolean('private');
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
        Schema::dropIfExists('bookings');
    }
}
