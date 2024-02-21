<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Field;

class FieldPolicy
{
    public function view(User $user, Field $field)
    {
        // Permitir a todos los usuarios ver campos
        return true;
    }

    public function manage(User $user, Field $field)
    {
        // Solo permitir a los administradores de venues (Venue Administrators) administrar campos
        return $user->hasRole('Venue Administrator');
    }
}
