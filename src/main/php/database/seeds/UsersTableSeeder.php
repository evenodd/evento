<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	[
	        	// 'id' => 1,
	        	'name' => 'Test event planner',
	        	'email' => 'event.planner@evento.com',
	        	'password' => bcrypt('secret'),
	        	'type' => 'event_planner',
	        	'verified' => true,
	        	'email_token' => null,
			],
			[
	        	// 'id' => 2,
	        	'name' => 'Test supplier',
	        	'email' => 'supplier@evento.com',
	        	'password' => bcrypt('secret'),
	        	'type' => 'supplier',
	        	'verified' => true,
	        	'email_token' => null,
			],
			[
	        	// 'id' => 3,
	        	'name' => 'Test host',
	        	'email' => 'host@evento.com',
	        	'password' => bcrypt('secret'),
	        	'type' => 'host',
	        	'verified' => true,
	        	'email_token' => null,
			],
			[
	        	// 'id' => 4,
	        	'name' => 'Test venue coordinator',
	        	'email' => 'venue.coordinator@evento.com',
	        	'password' => bcrypt('secret'),
	        	'type' => 'venue_coordinator',
	        	'verified' => true,
	        	'email_token' => null,
			]
    	]);

    }
}
