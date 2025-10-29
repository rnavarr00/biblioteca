@extends('layouts.master')

@section('title', 'Gestión usuarios')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Gestión de usuarios</h1>
        <a href=" {{ route('biblioteca.crearUsuario') }} " class="btn btn-success">
            <i class="fas fa-plus-circle"></i> Añadir usuario
        </a>
    </div>
    <table class="table table-striped table-hover align-middle w-auto">
        <thead class="thead-dark">
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Fecha de nacimiento</th>
                <th>ID</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="align-middle w-25">{{ $user->name }}</td>
                    <td class="align-middle">{{ $user->email}}</td>
                    <td class="align-middle">{{ $user->fecha_nacimiento->format('d/m/Y')}}</td>
                    <td class="align-middle">{{ $user->id }}</td>
                    <td class="align-middle">
                        <a href="{{ route('biblioteca.editarUsuario', ['id' => $user->id]) }}" class="btn btn-sm btn-warning mb-1">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('biblioteca.destroyUser', $user->id) }}"
                            method="POST"
                            style="display:inline;"
                            onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
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