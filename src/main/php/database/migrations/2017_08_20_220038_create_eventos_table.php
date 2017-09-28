<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_planner');
            $table->string('title');
            $table->longtext('description')->nullable();
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');
            $table->dateTime('rsvp_datetime')->nullable();
            $table->integer('max_guests')->nullable();
            $table->integer('venue');
            $table->string('host_name')->nullable();
            $table->string('host_email')->nullable();
            $table->boolean('from_host')->nullable();
            $table->json('preferences')->nullable();
            $table->float('price')->nullable();
            $table->boolean('private');
            $table->boolean('canceled')->default(false);
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
        Schema::dropIfExists('eventos');
    }
}
