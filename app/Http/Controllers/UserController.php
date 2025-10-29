<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function indexAdminUser() {
        $users = User::all();
        return view('gestion.user', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('biblioteca.crearUsuario');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|string|email|max:255|unique:users,email',
            'password'         => 'required|string|min:8',
            'fecha_nacimiento' => 'required|date|before:today',
        ]);

        $input['password'] = Hash::make($input['password']); 

        User::create($input);

        return redirect()->route('biblioteca.newUsuario');
    }

    // Función que devuelve la vista que verá el usuario una vez haya creado el Usuario
    public function newUser() {
        return view('biblioteca.newUsuario');
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
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('biblioteca.editarUsuario', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $input = $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'fecha_nacimiento' => 'required|date|before:today',
        ]);

        $user->update($input);

        return redirect()->route('gestion.user')->with('success', 'El usuario se ha actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('gestion.user')->with('success', 'Usuario eliminado correctamente.');
    }
}
