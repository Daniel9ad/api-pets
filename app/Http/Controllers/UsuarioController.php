<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return response()->json($usuarios, 200);
    }

    public function store(Request $request)
    {
        $usuario = Usuario::create($request->all());
        return response()->json($usuario, 201);
    }

    public function show($id)
    {
        $usuario = Usuario::find($id);
        if ($usuario) {
            return response()->json($usuario, 200);
        } else {
            return response()->json('Usuario no encontrado', 404);
        }
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);
        if ($usuario) {
            $usuario->update($request->all());
            return response()->json($usuario, 200);
        } else {
            return response()->json('Usuario no encontrado', 404);
        }
    }

    public function destroy($id)
    {
        $usuario = Usuario::find($id);
        if ($usuario) {
            $usuario->delete();
            return response()->json('Usuario eliminado', 200);
        } else {
            return response()->json('Usuario no encontrado', 404);
        }
    }
}
