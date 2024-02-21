@extends('app')

@section('content')
    
    <div class="container media:w-5 border p-4 mt-4">
        <h2 class="mb-3">Iniciar sesion</h2>
        <form>
            <a class="btn btn-primary" href="./login" role="button">Login</a>
        </form>
        <div class="mt-3">
            <h6>Si no tiene una cuenta, registrese</h6>
            <a class="btn btn-secondary" href="./register" role="button">Registrarse</a>
        </div>
    </div>
@endsection