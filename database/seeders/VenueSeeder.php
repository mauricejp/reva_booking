<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Venue;

class VenueSeeder extends Seeder
{
    public function run()
    {
        // Creamos 10 venues ficticios
        for ($i = 1; $i <= 10; $i++) {
            Venue::create([
                'name' => 'Venue ' . $i,
                // Puedes agregar más campos y datos aquí según sea necesario
            ]);
        }
    }
}

