@extends('layouts.master')

@section('title', 'Crear Categoría')

@section('content')
    <div class="container">
        {{-- Título centrado --}}
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center my-4">AÑADIR CATEGORÍA</h2>
            </div>
        </div>

        {{-- Categorías existentes en ancho completo --}}
        <div class="mb-4">
            @if($categorias->isEmpty())
                <p>No hay categorías creadas aún.</p>
            @else
                <div class="d-flex flex-wrap justify-content-start">
                    @foreach($categorias as $categoria)
                        <div class="bg-light font-weight-bold mr-3 mb-3 px-4 py-2 rounded shadow-sm">
                            {{ $categoria->nombre }}
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Formulario centrado --}}
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form action="{{ route('biblioteca.storeCategoria') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">
                            <i class="fas fa-pen"></i> Nombre:
                        </label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required placeholder="El nombre de la categoría tiene que ser distinto!">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-3 mb-3">
                            <i class="fas fa-plus"></i> AÑADIR CATEGORÍA
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection