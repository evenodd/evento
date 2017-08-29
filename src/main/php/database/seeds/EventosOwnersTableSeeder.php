<?php

use Illuminate\Database\Seeder;

class EventosOwnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('eventos_owners')->insert([
        	'user' => 1,
        	'evento' => 1,
        	'permissions' => ''
    	]);

    }
}
