<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BookingsTableSeeder::class);
        $this->call(BookingsOwnersTableSeeder::class);
        $this->call(VenueTableSeeder::class);
    }
}
