<?php

use Illuminate\Database\Seeder;

class BookingsOwnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bookings_owners')->insert([
        	'user' => 1,
        	'booking' => 1,
        	'permissions' => ''
    	]);

    }
}
