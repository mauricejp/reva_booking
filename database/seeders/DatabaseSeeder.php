<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            VenueSeeder::class,
            FieldSeeder::class,
            UserSeeder::class,
            BookingSeeder::class,
            // Agrega aquí cualquier otro seeder que desees ejecutar
        ]);
    }
}
