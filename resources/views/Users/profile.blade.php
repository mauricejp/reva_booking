@extends('app')


@section('content')

<body>
    <div class="container media:w-5 border p-4 mt-4">
        <h1>Bienvenido, {{ $user->name }}</h1>
        <p>Tu correo electrónico es: {{ $user->email }}</p>
        <p>Tu rol es: {{ $user->role }}</p> <!-- Aquí se mostrará el rol del usuario -->
        <!-- Otros datos del usuario -->
    </div>
</body>


@endsection