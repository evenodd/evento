<?php

use Illuminate\Database\Seeder;

class VenueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('venues')->insert([
        	'id' => 1,
        	'name' => 'HOYTS Broadway',
        	'address' => 'Broadway Shopping Centre, Level 2, Cnr Greek & Bay St, Broadway NSW 2007',
        	'contact' => json_encode('{"phone" : "(02) 9003 3820"}'),
        	'capacity' => 1000
    	]);
    }
}
