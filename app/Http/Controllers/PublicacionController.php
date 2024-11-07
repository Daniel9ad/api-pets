<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;

class PublicacionController extends Controller
{
    public function index()
    {
        $publicaciones = Publicacion::all();
        return response()->json($publicaciones, 200);
    }

    public function store(Request $request)
    {
        $publicacion = Publicacion::create($request->all());
        return response()->json($publicacion, 201);
    }

    public function show($id)
    {
        $publicacion = Publicacion::find($id);
        if ($publicacion) {
            return response()->json($publicacion, 200);
        } else {
            return response()->json('Publicacion no encontrada', 404);
        }
    }

    public function update(Request $request, $id)
    {
        $publicacion = Publicacion::find($id);
        if ($publicacion) {
            $publicacion->update($request->all());
            return response()->json($publicacion, 200);
        } else {
            return response()->json('Publicacion no encontrada', 404);
        }
    }

    public function destroy($id)
    {
        $publicacion = Publicacion::find($id);
        if ($publicacion) {
            $publicacion->delete();
            return response()->json('Publicacion eliminada', 200);
        } else {
            return response()->json('Publicacion no encontrada', 404);
        }
    }
}
