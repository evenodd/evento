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
        // $this->call(EventosTableSeeder::class);
        // $this->call(EventosOwnersTableSeeder::class);
        $this->call(VenueTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
