@extends('layouts.master')

@section('title', 'Biblioteca')

@section('content')
    <div class="container mt-4">
        <div class="row">
            @foreach ($libros as $libro)
            @php
                $media = $libro->users->avg(fn($user) => $user->pivot->nota);
            @endphp
                <div class="col-md-4 d-flex">
                <div class="card mb-4 w-100 d-flex flex-column" style="height: 500px;">
                    <img src="{{ $libro->portada }}" class="card-img-top" style="width: 100%; height: 300px; object-fit: contain;" alt="{{ $libro->titulo }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center mb-3">{{ $libro->titulo }}</h5>

                        <div class="mt-auto">
                            <div class="mb-3 p-2 bg-light border text-center rounded">
                                <strong>Nota media:</strong> {{ $media === null ? '-' : number_format($media, 1).'/ 10' }}
                            </div>
                            <a href="{{ url('/biblioteca/show/' . $libro->id) }}" class="btn btn-primary d-block">Más información</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="mt-4 w-100 d-flex justify-content-end">
                {{ $libros->links() }}
            </div>
        </div>
    </div>
@endsection