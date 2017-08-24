<?php

use Illuminate\Database\Seeder;

class EventosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('eventos')->insert([
        	'preferences' => json_encode("{ 'select' : { 'field' : 'Accept Invitation', 'options' : ['Yes', 'No'] } }"),
        	'title' => 'Cold one with the boyz',
        	'description' => 'What a dank event fuk yea',
        	'start_time' => '2017-08-25 10:00:00',
        	'end_time' => '2017-08-25 12:00:00',
        	'rsvp_time' => '2017-08-25 09:00:00',
        	'max_guests' => 3,
        	'private' => false,
        	'venue' => 0

    	]);
    }
}
