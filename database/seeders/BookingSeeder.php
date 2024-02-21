<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Field;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run()
    {
        // Obtenemos algunos usuarios y fields para asociar las reservas
        $users = User::all();
        $fields = Field::all();

        // Creamos 10 bookings ficticios asociados a usuarios y fields aleatorios
        for ($i = 1; $i <= 10; $i++) {
            Booking::create([
                'user_id' => $users->random()->id,
                'field_id' => $fields->random()->id,
                'start_time' => now()->addDays(rand(1, 30))->format('Y-m-d H:i:s'), // Ejemplo de fecha y hora aleatoria en los próximos 30 días
                'end_time' => now()->addDays(rand(1, 30))->format('Y-m-d H:i:s'), // Ejemplo de fecha y hora aleatoria en los próximos 30 días
                // Puedes agregar más campos y datos aquí según sea necesario
            ]);
        }
    }
}

