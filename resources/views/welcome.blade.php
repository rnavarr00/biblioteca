<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bienvenido!</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

        <style>
            /* Estilos para el fondo de pantalla */
            body {
                background-image: url('{{ asset('images/my-background.png') }}');
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center;
                min-height: 100vh;
                overflow: hidden;
            }

            /* Efecto al pasar el ratón sobre el div */
            .hover-effect {
                transition: all 0.3s ease; /* Transición suave para todos los cambios */
            }

            .hover-effect:hover {
                background-color: white !important;
                transform: scale(1.10);
            }
        </style>
    </head>
    <body>
    <header class="py-3">
        <div class="container">
            @if (Route::has('login'))
                <div class="d-flex justify-content-start">
                    @auth
                        <a href="{{ url('/biblioteca') }}" class="btn btn-outline-light btn-sm">
                            <i class="fas fa-book"></i> Biblioteca
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-3">
                            <i class="fas fa-sign-in-alt"></i> Iniciar sesión
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-outline-light btn-sm">
                                <i class="fas fa-user-plus"></i> Registrarse
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </header>
    <div class="container my-2">
        <!-- Logo -->
        <div class="text-center">
            <img src="{{ asset('images/my-logo.png') }}" alt="Logo" class="img-fluid mt-4" style="max-height:100px">
        </div>

        <!-- Div principal -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div    class="rounded shadow p-4 text-center mb-4 hover-effect" 
                        style="background-color: rgba(255, 255, 255, 0.85)">
                    <h1 class="display-5 fw-bold">Bienvenido!</h1>
                    <p class="fw-semibold px-4">
                        Desde aquí podrás ver los libros que tienes disponibles, los que ya has leído y las opiniones y valoraciones de otros usuarios.
                        Será una forma de gestionar tu biblioteca personal de forma digital!
                    </p>
                </div>
            </div>
        </div>

        {{-- Con la etiqueta @guest el texto solo se muestra a los usuarios no registrados 
            También se podría hacer con @if (!Auth::check())--}}
        @guest
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div    class="rounded shadow p-4 text-center mb-4 hover-effect"
                        style="background-color: rgba(255, 255, 255, 0.85)">
                    <p class="fw-semibold">¿Ya tienes usuario? Sigue explorando nuestro catálogo de libros!</p>
                    <a href="{{ route('login') }}" class="btn btn-primary">INICIAR SESIÓN</a>
                </div>
            </div>
            <div class="col-md-4">
                <div    class="rounded shadow p-4 text-center mb-4 hover-effect"
                        style="background-color: rgba(255, 255, 255, 0.85)">
                    <p class="fw-semibold">¿Todavía no eres parte de nuestra biblioteca online?</p>
                    <a href="{{ route('register') }}" class="btn btn-success">REGÍSTRATE!</a>
                </div>
            </div>
        </div>
        @endguest
    </div>
</body>
</html>
