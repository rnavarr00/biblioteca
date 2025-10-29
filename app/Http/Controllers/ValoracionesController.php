<?php

namespace App\Http\Controllers;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ValoracionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $libro = Libro::findOrFail($id);
        return view('biblioteca.crearValoracion', compact('libro'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $libro_id)
    {
        $request->validate([
            'nota' => 'required|integer|min:1|max:10',
            'valoracion' => 'required|string|max:1000',
        ]);

        $libro = Libro::findOrFail($libro_id);

        // Comprobar si ya existe una valoración para este usuario y libro
        $existe = DB::table('libro_user')
            ->where('user_id', Auth::id())
            ->where('libro_id', $libro->id)
            ->exists();

        if ($existe) {
            return redirect()->route('biblioteca.show', $libro_id)
                ->with('error', 'Ya has valorado este libro.');
        }

        DB::table('libro_user')->insert([
            'user_id' => Auth::id(),
            'libro_id' => $libro->id,
            'nota' => $request->input('nota'),
            'valoracion' => $request->input('valoracion'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('biblioteca.show', $libro_id)->with('success', '¡Tu valoración se ha guardado correctamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($libro_id)
    {
        $libro = Libro::findOrFail($libro_id);

        // Obtener la valoración del usuario autenticado para este libro
        $valoracion = DB::table('libro_user')
            ->where('user_id', Auth::id())
            ->where('libro_id', $libro->id)
            ->first();

        return view('biblioteca.editarValoracion', compact('libro', 'valoracion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $libro_id)
    {
        $request->validate([
            'nota' => 'required|integer|min:1|max:10',
            'valoracion' => 'required|string|max:1000',
        ]);

        $libro = Libro::findOrFail($libro_id);

        // Actualizar la valoración del usuario autenticado para este libro
        DB::table('libro_user')
            ->where('user_id', Auth::id())
            ->where('libro_id', $libro->id)
            ->update([
                'nota' => $request->input('nota'),
                'valoracion' => $request->input('valoracion'),
                'updated_at' => now(),
            ]);

        return redirect()->route('biblioteca.show', $libro_id)
            ->with('success', '¡Tu valoración ha sido actualizada correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
