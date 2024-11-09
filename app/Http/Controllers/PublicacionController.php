<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;
use App\Models\ImagenMascota;
use Illuminate\Support\Facades\Storage;


class PublicacionController extends Controller
{
    public function listarMascotasDisponibles(Request $request)
    {
        $especieId = $request->query('especie');
        $query = Publicacion::where('estado', true);
    
        if ($especieId !== null) {
            $query->where('especie_id', $especieId);
        }
    
        $publicaciones = $query->get(['id', 'titulo', 'edad', 'raza', 'ciudad_id', 'estado', 'especie_id'])
            ->map(function ($publicacion) {
                return [
                    'id' => $publicacion->id,
                    'titulo' => $publicacion->titulo,
                    'edad' => $publicacion->edad,
                    'raza' => $publicacion->raza,
                    'ciudad' => $publicacion->ciudad ? $publicacion->ciudad->nombre : 'Desconocido',
                    'imagen' => ImagenMascota::where('id_publicacion', $publicacion->id)->get('urlIMG')->first() ?? 'https://via.placeholder.com/150',
                    'disponible' => $publicacion->estado,
                    'especie' => $publicacion->especie_id,
                ];
            });
    
        return response()->json([
            'transaction' => true,
            'message' => 'mascotas disponibles',
            'data' => $publicaciones
        ], 200);
    }
    






    
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
