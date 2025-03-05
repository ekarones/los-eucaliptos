<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{

    public function index()
    {
        return response()->json(Usuario::all(), 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:6',
            'estado' => 'required|boolean',
        ]);

        $usuario = Usuario::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'estado' => $validatedData['estado'],
        ]);

        return response()->json([
            'message' => 'Usuario creado correctamente',
            //'usuario' => $usuario
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:usuarios,email,' . $usuario->id,
            'password' => 'sometimes|string|min:6',
            'estado' => 'sometimes|boolean',
        ]);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $usuario->update($validatedData);

        return response()->json([
            'message' => 'Usuario actualizado correctamente',
            //'usuario' => $usuario
        ], 200);
    }


    public function destroy(Usuario $usuario)
    {
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $usuario->delete();
        return response()->json(['message' => 'Usuario eliminado con éxito'], 200);
    }
}
