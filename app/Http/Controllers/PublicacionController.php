<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;

class PublicacionController extends Controller
{
    public function listarMascotasDisponibles()
    {
        $mascotas = Publicacion::where('estado', 'disponible')
            // ->with(['mascota', 'imagenes', 'usuario'])
            ->get();

        return response()->json($mascotas);
    }
}
