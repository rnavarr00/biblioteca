@extends('layouts.master')

@section('title', 'Crear Libro')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center my-4">AÑADIR LIBRO</h2>
            <form action="{{ route('biblioteca.storeLibro') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="titulo">
                        <i class="fas fa-book"></i> Título:
                    </label>
                    <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo') }}" required>
                </div>
                <div class="form-group">
                    <label for="autor">
                        <i class="fas fa-user"></i> Autor:
                    </label>
                    <input type="text" class="form-control" id="autor" name="autor" value="{{ old('autor') }}" required>
                </div>
                <div class="form-group">
                    <label for="resumen">
                        <i class="fas fa-align-left"></i> Resumen:
                    </label>
                    <textarea class="form-control" id="resumen" name="resumen" required rows="6">{{ old('resumen') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="fecha_publicacion">
                        <i class="fas fa-calendar-alt"></i> Fecha de publicación:
                    </label>
                    <input type="date" class="form-control" id="fecha_publicacion" name="fecha_publicacion" value="{{ old('fecha_publicacion') }}" required>
                </div>
                <div class="form-group">
                    <label for="precio">
                        <i class="fas fa-dollar-sign"></i> Precio:
                    </label>
                    <input type="number" class="form-control" id="precio" name="precio" step="0.01" min="0" value="{{ old('precio') }}" required>
                </div>
                <div class="form-group">
                    <label for="portada">
                        <i class="fas fa-image"></i> Portada:
                    </label>
                    <input type="text" class="form-control" id="portada" name="portada" value="{{ old('portada') }}" required>
                </div>
                <div class="form-group">
                    <label for="edad_minima">
                        <i class="fas fa-child"></i> Edad mínima recomendada:
                    </label>
                    <select class="form-control" id="edad_minima" name="edad_minima" required size="5">
                        <option value="0" {{ old('edad_minima') == 0 ? 'selected' : '' }}>Sin restricción</option>
                        @for ($edad = 1; $edad <= 18; $edad++)
                            <option value="{{ $edad }}" {{ old('edad_minima') == $edad ? 'selected' : '' }}>{{ $edad }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label for="categoria_id">
                        <i class="fas fa-tags"></i> Categoría:
                    </label>
                    <select class="form-control" id="categoria_id" name="categoria_id" required>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="leido">
                        <i class="fas fa-check-circle"></i> Leído:
                    </label>
                    <select class="form-control" id="leido" name="leido" required>
                        <option value="0" {{ old('leido') == "0" ? 'selected' : '' }}>No</option>
                        <option value="1" {{ old('leido') == "1" ? 'selected' : '' }}>Sí</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-3 mb-3">
                        <i class="fas fa-plus"></i> AÑADIR LIBRO
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection