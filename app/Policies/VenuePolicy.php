<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Venue;

class VenuePolicy
{
    public function view(User $user, Venue $venue)
    {
        // Permitir a todos los usuarios ver venues
        return true;
    }

    public function manage(User $user, Venue $venue)
    {
        // Solo permitir a los administradores de venues (Venue Administrators) administrar venues
        return $user->hasRole('Venue Administrator');
    }
}
