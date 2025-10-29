@extends('layouts.master')

@section('title', 'Crear Usuario')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2 class="text-center my-4">AÑADIR USUARIO</h2>
        <form action="{{ route('biblioteca.storeUser') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="name">
                    <i class="fas fa-user"></i> Nombre:
                </label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label for="email">
                    <i class="fas fa-envelope"></i> Correo electrónico:
                </label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label for="password">
                    <i class="fas fa-lock"></i> Contraseña:
                </label>
                <input type="password" class="form-control" id="password" name="password" required placeholder="Introduce una contraseña segura.">
            </div>
            <div class="form-group">
                <label for="fecha_nacimiento">
                    <i class="fas fa-calendar-alt"></i> Fecha de nacimiento:
                </label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary mt-3 mb-3">
                    <i class="fas fa-plus"></i> AÑADIR USUARIO
                </button>
            </div>
        </form>
    </div>
</div>
@endsection