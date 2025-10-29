<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BibliotecaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $query = Libro::query();

        if ($request->filled('categorias')) {
            $query->whereIn('categoria_id', $request->categorias);
        }

        // Primero comprobamos que haya algún usuario logueado
        if (Auth::check()) {
            // Después cogeremos ese usuario como un objeto con todos sus atributos
            $user = Auth::user();
            // Como fecha_nacimiento ya está casteada a date, podemos coger directamente la función age
            $edadUsuario = $user->fecha_nacimiento->age;

            // Filtrar libros según la edad del usuario
            $query->where(function($q) use ($edadUsuario) {
                $q->where('edad_minima', 0) // Si la edad_minima es 0, también mostrará los libros
                ->orWhere('edad_minima', '<=', $edadUsuario);
            });
        }

        $query->orderBy('titulo', 'asc');
        $libros = $query->with('users')->paginate(6);
        $categorias = Categoria::all();

        return view('biblioteca.biblioteca', compact('libros', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();

        return view('biblioteca.crearLibro', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'titulo'            => 'required|string|max:255',
            'autor'             => 'required|string|max:255',
            'resumen'           => 'required|string',
            'fecha_publicacion' => 'required|date',
            'precio'            => 'required|numeric|min:0',
            'portada'           => 'required|string|max:255',
            'edad_minima'       => 'required|integer|min:0|max:18',
            'categoria_id'      => 'required|exists:categorias,id',
            'leido'             => 'required|boolean',
        ]);

        Libro::create($input);

        return redirect()->route('biblioteca.newLibro');
    }

    // Función que devuelve la vista que verá el usuario una vez haya creado el Libro
    public function new() {
        return view('biblioteca.newLibro');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Buscamos los libros que tienen relación con los usuarios, para poder obtener la media
        $libro = Libro::with('users')->findOrFail($id);

        // Cogemos la media de las notas, que guardaremos en una variable $media
        $media = $libro->users->avg(function($user) {
            return $user->pivot->nota;
        });

        $valoraciones = $libro->users->map(function($user) {
            return [
                'nombre' => $user->name,
                'nota' => $user->pivot->nota,
                'valoracion' => $user->pivot->valoracion
            ];
        });

        // Comprobar si el usuario ya ha valorado el libro
        $yaValorado = false;
        if (Auth::check()) {
            $yaValorado = $libro->users->contains(function($user) {
                return $user->id === Auth::id();
            });
        }

        return view('biblioteca.mostrar', [
                    'libro'=> $libro,
                    'id' => $id,
                    'media' => $media,
                    'valoraciones' => $valoraciones,
                    'yaValorado' => $yaValorado
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $libro = Libro::findOrFail($id);
        $categorias = Categoria::all(); 

        return view('biblioteca.editarLibro', compact('libro', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $libro = Libro::findOrFail($id);

        $input = $request->validate([
            'titulo' => ['required', 'string', 'max:255', 'unique:libros,titulo,' . $libro->id],
            'autor' => 'required|string|max:255',
            'resumen' => 'required|string',
            'fecha_publicacion' => 'required|date',
            'precio' => 'required|numeric|min:0',
            'portada' => 'required|string|max:255',
            'edad_minima' => 'required|integer|min:0|max:18',
            'categoria_id' => 'required|exists:categorias,id',
            'leido' => 'required|boolean',
        ]);

        $libro->update($input);

        return redirect()->route('gestion.libro')->with('success', 'Libro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $libro = Libro::findOrFail($id);
        $libro->delete();

        return redirect()->route('gestion.libro')->with('success', 'Libro eliminado correctamente.');
    }

    public function indexAdminLibros() {
        $libros = Libro::all();
        return view('gestion.libro', compact('libros'));
    }
}
