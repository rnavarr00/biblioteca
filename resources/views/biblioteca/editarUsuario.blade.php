@extends('layouts.master')

@section('title', 'Editar Usuario')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2 class="text-center my-4">EDITAR USUARIO</h2>
        <form action="{{ route('biblioteca.updateUser', ['id' => $user->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">
                    <i class="fas fa-user"></i> Nombre:
                </label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">
                    <i class="fas fa-envelope"></i> Correo electrónico:
                </label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>
            <div class="form-group">
                <label for="fecha_nacimiento">
                    <i class="fas fa-calendar-alt"></i> Fecha de nacimiento:
                </label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ $user->fecha_nacimiento->format('Y-m-d') }}" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary mt-3 mb-3">
                    <i class="fas fa-plus"></i> EDITAR USUARIO
                </button>
            </div>
        </form>
    </div>
</div>
@endsection