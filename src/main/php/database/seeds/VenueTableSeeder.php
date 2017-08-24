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
        	'name' => "Somewhere idk",
        	'address' => '12 Something Rd, Place',
    	]);
    }
}
