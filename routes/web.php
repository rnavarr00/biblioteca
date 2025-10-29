<?php

use App\Http\Controllers\BibliotecaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValoracionesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // Si un usuario ya logueado le da a iniciar sesión le redirigirá a la biblioteca
    return redirect('biblioteca');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Vistas para editar, actualizar o eliminar usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Vistas generales para el usuario
    // Vista para ver el catálogo con todos los libros
    Route::get('/biblioteca', [BibliotecaController::class, 'index'])->name('biblioteca.biblioteca');

    // Vista para poder ver toda la información de un libro concreto
    Route::get('/biblioteca/show/{id}', [BibliotecaController::class, 'show'])->name('biblioteca.show');

    // Vista para crear una valoración de un libro
    Route::get('biblioteca/crearValoracion/{id}', [ValoracionesController::class, 'create'])->name('biblioteca.crearValoracion');
    // Guardar una valoración 
    Route::post('biblioteca/crearValoracion/{id}', [ValoracionesController::class, 'store'])->name('biblioteca.storeValoracion');
    // Vista para editar una valoración de un libro
    Route::get('biblioteca/editarValoracion/{id}', [ValoracionesController::class, 'edit'])->name('biblioteca.editarValoracion');
    // Actualizar una valoración de un libro
    Route::put('biblioteca/editarValoracion/{id}', [ValoracionesController::class, 'update'])->name('biblioteca.updateValoracion');

    
    Route::middleware(['isAdmin'])->group(function () {
        // Vista para crear, editar y eliminar un Libro
        Route::get('biblioteca/crearLibro', [BibliotecaController::class, 'create'])->name('biblioteca.crearLibro');
        Route::post('biblioteca/crearLibro', [BibliotecaController::class, 'store'])->name('biblioteca.storeLibro');
        Route::get('biblioteca/newLibro', [BibliotecaController::class, 'new'])->name('biblioteca.newLibro');
        Route::get('biblioteca/editarLibro/{id}', [BibliotecaController::class, 'edit'])->name('biblioteca.editarLibro');
        Route::put('biblioteca/editarLibro/{id}', [BibliotecaController::class, 'update'])->name('biblioteca.updateLibro');
        Route::delete('/libro/{id}', [BibliotecaController::class, 'destroy'])->name('biblioteca.destroyLibro');

        
        // Vista para crear, editar y eliminar una Categoria
        Route::get('biblioteca/crearCategoria', [CategoriaController::class, 'create'])->name('biblioteca.crearCategoria');
        Route::post('biblioteca/crearCategoria', [CategoriaController::class, 'store'])->name('biblioteca.storeCategoria');
        Route::get('biblioteca/newCategoria', [CategoriaController::class, 'new'])->name('biblioteca.newCategoria');
        Route::get('biblioteca/editarCategoria/{id}', [CategoriaController::class, 'edit'])->name('biblioteca.editarCategoria');
        Route::put('biblioteca/editarCategoria/{id}', [CategoriaController::class, 'update'])->name('biblioteca.updateCategoria');
        Route::delete('/categoria/{id}', [CategoriaController::class, 'destroy'])->name('biblioteca.destroyCategoria');


        // Vista para crear, editar y eliminar Usuario
        Route::get('biblioteca/crearUsuario', [UserController::class, 'create'])->name('biblioteca.crearUsuario');
        Route::post('biblioteca/crearUsuario', [UserController::class, 'store'])->name('biblioteca.storeUser');
        Route::get('biblioteca/newUsuario', [UserController::class, 'newUser'])->name('biblioteca.newUsuario');
        Route::get('biblioteca/editarUsuario/{id}', [UserController::class, 'edit'])->name('biblioteca.editarUsuario');
        Route::put('biblioteca/editarUsuario/{id}', [UserController::class, 'update'])->name('biblioteca.updateUser');
        Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('biblioteca.destroyUser');


        // Vistas para las gestiones
        Route::get('/gestion/libro', [BibliotecaController::class, 'indexAdminLibros'])->name('gestion.libro');
        Route::get('/gestion/categoria', [CategoriaController::class, 'indexAdminCategoria'])->name('gestion.categoria');
        Route::get('/gestion/user', [UserController::class, 'indexAdminUser'])->name('gestion.user');

    });
});

require __DIR__.'/auth.php';
