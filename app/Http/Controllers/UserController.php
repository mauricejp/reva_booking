<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        // Obtener el usuario autenticado
        $user = auth()->user();

        // Pasar los datos del usuario a la vista
        return view('Users\profile')->with('user', $user);
    }
}
