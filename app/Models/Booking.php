<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use App\Models\Booking;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'field_id',
        'start_time',
        'end_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    // Otros métodos y relaciones aquí...
}

class BookingSeeder extends Seeder
{
    public function run()
    {
        Booking::factory()->count(50)->create();
    }
}