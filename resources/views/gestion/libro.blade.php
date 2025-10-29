@extends('layouts.master')

@section('title', 'Gestión libros')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Gestión de libros</h1>
        <a href="{{ route('biblioteca.crearLibro') }} " class="btn btn-success">
            <i class="fas fa-plus-circle"></i> Añadir libro
        </a>
    </div>

    <table class="table table-striped table-hover align-middle">
        <thead class="thead-dark">
            <tr>
                <th>Portada</th>
                <th>Título</th>
                <th>Autor</th>
                <th>ID</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($libros as $libro)
                <tr id="libro-{{ $libro->id }}">
                    <td>
                        <img src="{{ $libro->portada }}" alt="Portada" style="height: 80px; object-fit: cover;">
                    </td>
                    <td class="align-middle w-25">{{ $libro->titulo }}</td>
                    <td class="align-middle w-25">{{ $libro->autor }}</td>
                    <td class="align-middle">{{ $libro->id }}</td>
                    <td class="align-middle">
                        <a href="{{ url('/biblioteca/show/' . $libro->id) }}" class="btn btn-sm btn-info mb-1">
                            <i class="fas fa-info-circle"></i> Más información
                        </a>
                        <a href="{{ route('biblioteca.editarLibro', ['id' => $libro->id]) }}" class="btn btn-sm btn-warning mb-1">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('biblioteca.destroyLibro', $libro->id) }}"
                            method="POST"
                            style="display:inline;"
                            onsubmit="return confirm('¿Estás seguro de eliminar este libro?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger mb-1">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection