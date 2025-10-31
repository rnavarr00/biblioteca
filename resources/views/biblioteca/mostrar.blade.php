@extends('layouts.master')

@section('title', 'Mostrar libro')

@section('content')

<div class="container mt-5">
    <div class="row align-items-start">
        <!-- Imagen de portada -->
        <div class="col-md-5 mb-4">
            <div class="shadow-lg rounded overflow-hidden">
                <img src="{{ $libro->portada }}" alt="Portada del libro {{ $libro->titulo }}" class="img-fluid img-fluid w-75 mx-auto d-block">
            </div>
        </div>

        <!-- Detalles del libro -->
        <div class="col-md-7">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h1 class="card-title text-primary mb-3">
                        <i class="fas fa-book mr-2"></i>{{ $libro->titulo }}
                    </h1>

                    <h5 class="card-subtitle text-muted mb-3">
                        <i class="fas fa-user mr-2"></i>{{ $libro->autor }}
                    </h5>

                    <p class="mb-4">{{ $libro->resumen }}</p>

                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            <strong>Fecha de publicación:</strong> {{ $libro->fecha_publicacion->format('d / m / Y') }}
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-euro-sign mr-2"></i>
                            <strong>Precio:</strong> {{ $libro->precio }} €
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-child mr-2"></i>
                            <strong>Edad recomendada:</strong> {{ $libro->edad_minima }} años
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-tags mr-2"></i>
                            <strong>Categoría:</strong> {{ $libro->categoria ? $libro->categoria->nombre : 'Sin categoría' }}
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-eye mr-2"></i>
                            <strong>Leído:</strong> {{ $libro->leido ? 'Sí' : 'No' }}
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-star mr-2 text-warning"></i>
                            <strong>Nota media:</strong>
                            {{ $media ? number_format($media, 2) : 'Sin valoraciones' }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Botones -->
<div class="container mt-4">
    <div class="text-right">
        <a href="{{ route('gestion.libro') }}#libro-{{ $libro->id }}" class="btn btn-primary">
            <i class="fas fa-edit mr-1"></i> Gestión libro
        </a>
        @if(Auth::check())
            @if($yaValorado)
                <a href="{{ route('biblioteca.editarValoracion', $libro->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit mr-1"></i> Editar valoración
                </a>
            @else
                <a href="{{ route('biblioteca.crearValoracion', $libro->id) }}" class="btn btn-primary">
                    <i class="fas fa-star mr-1"></i> Valorar libro
                </a>
            @endif
        @endif
        <a href="{{ url()->previous() }}" class="btn btn-outline-primary mr-2">
            <i class="fas fa-arrow-left mr-1"></i> Volver atrás
        </a>
    </div>
</div>

<div class="container mt-4">
    <h2 class="text-primary mb-3">
        <i class="fas fa-comments mr-2"></i>Valoraciones
    </h2>
</div>
<!-- Valoraciones de los usuarios -->
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            @if($valoraciones->isEmpty())
                <p>No hay valoraciones para este libro.</p>
            @else
                @foreach($valoraciones as $valoracion)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $valoracion['nombre'] }}</h5>
                            <p class="card-text"><strong>Nota:</strong> {{ $valoracion['nota'] }} / 10</p>
                            <p class="card-text"><strong>Comentario:</strong> {{ $valoracion['valoracion'] }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection