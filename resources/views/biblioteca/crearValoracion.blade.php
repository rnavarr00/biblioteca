@extends('layouts.master')

@section('title', 'Crear valoración')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Valorar: {{ $libro->titulo }}</h4>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">

                        <!-- Portada del libro -->
                        <div class="col-md-5 text-center mb-3 mb-md-0">
                            <img src="{{ $libro->portada }}" alt="Portada del libro" class="img-fluid rounded border" style="max-height: 350px; object-fit: contain;">
                        </div>

                        <!-- Formulario -->
                        <div class="col-md-7">
                            <form action=" {{ route('biblioteca.storeValoracion', $libro->id) }} " method="POST">
                                @csrf

                                <!-- Nota -->
                                <div class="form-group mb-4">
                                    <label for="nota" class="font-weight-bold">
                                        <i class="fas fa-star text-warning"></i> Nota
                                    </label>
                                    <select name="nota" id="nota" class="form-control" required>
                                        <option value="">Selecciona una nota</option>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <!-- Opinión -->
                                <div class="form-group mb-4">
                                    <label for="valoracion" class="font-weight-bold">
                                        <i class="fas fa-comment-alt text-info"></i> Valoración
                                    </label>
                                    <textarea name="valoracion" id="valoracion" class="form-control" rows="5" placeholder="Escribe tu valoración..." required></textarea>
                                </div>

                                <!-- Botón enviar -->
                                <button type="submit" class="btn btn-success btn-block">
                                    <i class="fas fa-check"></i> Enviar valoración
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