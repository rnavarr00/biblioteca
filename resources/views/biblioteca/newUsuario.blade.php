@extends('layouts.master')

@section('title', 'Nuevo Usuario')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h2 class="my-5">
                <i class="fas fa-check-circle text-success"></i>
                ¡Nuevo usuario creado!
            </h2>
            <p class="lead">¿Qué quieres hacer ahora?</p>

            <div class="mt-4">
                <a href="{{ route('biblioteca.crearUsuario') }}" class="btn btn-primary mr-3">
                    <i class="fas fa-plus-circle"></i> Crear nuevo usuario
                </a>

                <a href="{{ route('biblioteca.biblioteca') }}" class="btn btn-secondary">
                    <i class="fas fa-book"></i> Volver a la biblioteca
                </a>
            </div>
        </div>
    </div>
</div>
@endsection