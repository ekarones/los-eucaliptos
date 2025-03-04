<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        return response()->json(Usuario::all());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'email1' => 'required|email1',
            'password' => 'required|string|min:6',
            'estado' => 'required|boolean',
        ]);

        $usuario = Usuario::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'email1' => $validatedData['email1'],
            'password' => Hash::make($validatedData['password']),
            'estado' => $validatedData['estado'],

        ]);

        return response()->json([
            'message' => 'Usuario creado correctamente',
            'usuario' => $usuario
        ], 201);
    }

    public function update(Request $request, string $id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,'.$usuario->id,
            'email1' => 'required|email|unique:usuarios,email1,'.$usuario->id,
            'password' => 'nullable|string|min:6',
            'estado' => 'required|boolean',
        ]);

        $usuario->name = $validatedData['name'];
        $usuario->email = $validatedData['email'];
        $usuario->email1 = $validatedData['email1'];
        if (!empty($validatedData['password'])) {
            $usuario->password = Hash::make($validatedData['password']);
        }
        $usuario->estado = $validatedData['estado'];
        $usuario->save();

        return response()->json([
            'message' => 'Usuario actualizado correctamente',
            'usuario' => $usuario
        ], 200);
    }

    public function destroy(Usuario $usuario){
        $usuario->delete();
        return response()->json(['message' => 'Usuario eliminado con exito'],200);
    }

}
