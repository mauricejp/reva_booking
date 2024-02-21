<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Field;
use Illuminate\Database\Seeder;
use App\Models\Venue;


class Venue extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'city', 'state', 'country'];

    // Aquí puedes definir relaciones con otras tablas si es necesario
    public function fields()
    {
        return $this->hasMany(Field::class);
    }
}

class VenueSeeder extends Seeder
{
    public function run()
    {
        Venue::factory()->count(10)->create();
    }
}