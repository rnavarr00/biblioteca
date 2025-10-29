@extends('layouts.master')

@section('title', 'Nueva Categoría')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h2 class="my-5">
                <i class="fas fa-check-circle text-success"></i>
                ¡Nueva categoría creada!
            </h2>
            <p class="lead">¿Qué quieres hacer ahora?</p>

            <div class="mt-4">
                <a href="{{ route('biblioteca.crearCategoria') }}" class="btn btn-primary mr-3">
                    <i class="fas fa-plus-circle"></i> Crear nueva categoría
                </a>

                <a href="{{ route('biblioteca.biblioteca') }}" class="btn btn-secondary">
                    <i class="fas fa-book"></i> Volver a la biblioteca
                </a>
            </div>
        </div>
    </div>
</div>
@endsection