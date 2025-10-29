@extends('layouts.master')

@section('title', 'Editar Categoría')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2 class="text-center my-4">EDITAR CATEGORÍA</h2>

        <form action="{{ route('biblioteca.updateCategoria', ['id' => $categoria->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">
                    <i class="fas fa-pen"></i> Nombre:
                </label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $categoria->nombre }}" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary mt-3 mb-3">
                    <i class="fas fa-plus"></i> EDITAR CATEGORÍA
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
