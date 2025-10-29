@extends('layouts.master')

@section('title', 'Editar Valoración')

@section('content')
    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card shadow">
                <div class="card-header bg-warning text-white text-center">
                    <h4>Editar valoración: {{ $libro->titulo }}</h4>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">

                        <!-- Portada del libro -->
                        <div class="col-md-5 text-center mb-3 mb-md-0">
                            <img src="{{ $libro->portada }}" alt="Portada del libro" class="img-fluid rounded border" style="max-height: 350px; object-fit: contain;">
                        </div>

                        <!-- Formulario -->
                        <div class="col-md-7">
                            <form action="{{ route('biblioteca.updateValoracion', $libro->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Nota -->
                                <div class="form-group mb-4">
                                    <label for="nota" class="font-weight-bold">
                                        <i class="fas fa-star text-warning"></i> Nota
                                    </label>
                                    <select name="nota" id="nota" class="form-control" required>
                                        <option value="">Selecciona una nota</option>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}" {{ $valoracion->nota == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>

                                <!-- Opinión -->
                                <div class="form-group mb-4">
                                    <label for="valoracion" class="font-weight-bold">
                                        <i class="fas fa-comment-alt text-info"></i> Valoración
                                    </label>
                                    <textarea name="valoracion" id="valoracion" class="form-control" rows="5" placeholder="Escribe tu valoración..." required>{{ old('valoracion', $valoracion->valoracion) }}</textarea>
                                </div>

                                <!-- Botón enviar -->
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-save"></i> Guardar cambios
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection