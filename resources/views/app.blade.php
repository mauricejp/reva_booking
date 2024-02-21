<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reva Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background-image: url(''); /* Ruta de la imagen de fondo */
            background-size: cover; /* Cubre todo el fondo */
            background-position: center; /* Centra la imagen */
        }
        .color-container {
            width: 16px;
            height: 16px;
            display: inline-block;
            border-radius: 4px;
        }    
        a {
            text-decoration: none;
        }   
    </style>
  </head>
  <body>

    <nav class="mb-4 navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="./home">Reva Reservas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./home">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./venues">Venues</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('bookings.index') }}">Mis reservas</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="./profile">Perfil</a>
                    </li>
                    @endauth
                </ul>
    
                @guest
                <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                    <li class="nav-item">
                        <a class="nav-link btn btn-success" href="{{ route('login') }}">Iniciar sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-secondary" href="{{ route('register') }}">Registrarse</a>
                    </li>
                </ul>
                @endguest
    
                @auth
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Cerrar sesión</button>
                        </form>
                    </li>
                </ul>
                @endauth
                    
            </div>
        </div>
    </nav>
    
    
        @yield('content')
  </body>
</html>
