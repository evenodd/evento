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
            $table->string('title');
            $table->longtext('description')->nullable();
            $table->dateTime('start-datetime');
            $table->dateTime('end-datetime');
            $table->dateTime('rsvp-datetime')->nullable();
            $table->integer('max-guests')->nullable();
            $table->integer('venue');
            $table->string('host-name')->nullable();
            $table->string('host-email')->nullable();
            $table->boolean('from-host')->nullable();
            $table->json('preferences')->nullable();
            $table->float('price')->nullable();
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
        Schema::dropIfExists('eventos');
    }
}
