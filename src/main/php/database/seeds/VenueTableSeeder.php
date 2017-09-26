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
        $preferences = new \stdClass();
        $preferences->phone = "(02) 9003 3820";
        DB::table('venues')->insert([
        	// 'id' => 1,
        	'name' => 'HOYTS Broadway',
            'owner' => 4,
        	'address' => 'Broadway Shopping Centre, Level 2, Cnr Greek & Bay St, Broadway NSW 2007',
        	'contact' => json_encode($preferences),
        	'capacity' => 1000
    	]);
    }
}
