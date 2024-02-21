<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function makeVenueAdministrator($userId)
    {
        // Encuentra al usuario por su ID
        $user = User::findOrFail($userId);

        // Verifica si el usuario ya tiene el rol de Venue Administrator
        if ($user->hasRole('Venue Administrator')) {
            // Si ya tiene el rol, no es necesario hacer ningún cambio
            return 'El usuario ya es un administrador de venue.';
        }

        // Si el usuario no tiene el rol de Venue Administrator, asigna ese rol
        $role = Role::where('name', 'Venue Administrator')->first();
        $user->assignRole($role);

        return 'El usuario ha sido actualizado a administrador de venue exitosamente.';
    }
}
