<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function updateRole(Request $request, $id)
    {
        // Validación
        $request->validate([
            'role' => 'required|in:admin,user'
        ]);

        // Buscar usuario
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        // Evitar que un admin se saque su propio rol
        if ($user->id === $request->user()->id) {
            return response()->json([
                'message' => 'No podés quitarte tu propio rol de admin'
            ], 403);
        }

        // Actualizar rol
        $user->role = $request->role;
        $user->save();

        return response()->json([
            'message' => 'Rol actualizado correctamente',
            'user' => $user
        ], 200);
    }
}
