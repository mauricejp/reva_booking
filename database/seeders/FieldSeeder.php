<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Field;
use App\Models\Venue;

class FieldSeeder extends Seeder
{
    public function run()
    {
        // Obtenemos algunos venues para asociar los campos
        $venues = Venue::all();

        // Creamos 10 fields ficticios asociados a venues aleatorios
        for ($i = 1; $i <= 10; $i++) {
            Field::create([
                'name' => 'Field ' . $i,
                'venue_id' => $venues->random()->id,
                // Puedes agregar más campos y datos aquí según sea necesario
            ]);
        }
    }
}

