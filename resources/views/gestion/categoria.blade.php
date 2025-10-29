@extends('layouts.master')

@section('title', 'Gestión categorías')

@section('content')
    <div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Gestión de categorías</h1>
        <a href="{{ route('biblioteca.crearCategoria') }}" class="btn btn-success">
            <i class="fas fa-plus-circle"></i> Añadir categoría
        </a>
    </div>
    <table class="table table-striped table-hover align-middle w-auto">
        <thead class="thead-dark">
            <tr>
                <th>Nombre</th>
                <th>ID</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $categoria)
                <tr>
                    <td class="align-middle w-25">{{ $categoria->nombre }}</td>
                    <td class="align-middle">{{ $categoria->id }}</td>
                    <td class="align-middle">
                        <a href="{{ route('biblioteca.editarCategoria', ['id' => $categoria->id]) }}" class="btn btn-sm btn-warning mb-1">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('biblioteca.destroyCategoria', $categoria->id) }}"
                            method="POST"
                            style="display:inline;"
                            onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?')">
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