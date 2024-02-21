<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use App\Models\Field;

class Field extends Model
{
    protected $fillable = ['name', 'type', 'venue_id'];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // Otros métodos y relaciones aquí...
}

class FieldSeeder extends Seeder
{
    public function run()
    {
        Field::factory()->count(20)->create();
    }
}