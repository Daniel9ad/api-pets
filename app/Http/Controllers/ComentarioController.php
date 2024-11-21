<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public static function createComentario(Request $request) {
        $validate = $request->validate([
            'comentario' => 'required',
            'calificacion' => 'required',
            'fecha' => 'required',
            'id_usuario' => 'required',
            'id_publicacion' => 'required',
            'id_comentario_padre' => 'nullable'
        ]);
        $comentario = Comentario::create($validate);
        return response()->json([
            'transaction' => true,
            'message' => 'Comentario creado',
            'data' => $comentario
        ], 201);
    }

    public static function createRespuestaComentario(Request $request) {
        $validate = $request->validate([
            'comentario' => 'required',
            'calificacion' => 'nullable',
            'fecha' => 'required',
            'id_usuario' => 'required',
            'id_publicacion' => 'required',
            'id_comentario_padre' => 'required'
        ]);
        $comentario = Comentario::create($validate);
        return response()->json([
            'transaction' => true,
            'message' => 'Respuesta creada',
            'data' => $comentario
        ], 201);
    }

    public static function getComentariosPublicacion($id) {
        $comentarios = Comentario::where('id_publicacion', $id)
            ->with('usuario')
            ->with('comentariosHijos')
            ->get();
        return response()->json([
            'transaction' => true,
            'message' => 'Comentarios de la publicacion',
            'data' => $comentarios
        ], 200);
    }

    public static function getComentariosUsuario($id) {
        $comentarios = Comentario::where('id_usuario', $id)
            ->with('publicacion')
            ->get();
        return response()->json([
            'transaction' => true,
            'message' => 'Comentarios del usuario',
            'data' => $comentarios
        ], 200);
    }

    public static function getComentario($id) {
        $comentario = Comentario::find($id);
        if ($comentario) {
            return response()->json([
                'transaction' => true,
                'message' => 'Comentario encontrado',
                'data' => $comentario
            ], 200);
        } else {
            return response()->json([
                'transaction' => false,
                'message' => 'Comentario no encontrado'
            ], 404);
        }
    }

    public static function getAllRespuestasComentario($id) {
        $comentarios = Comentario::where('id_comentario_padre', $id)
            ->with('usuario')
            ->get();
        return response()->json([
            'transaction' => true,
            'message' => 'Respuestas del comentario',
            'data' => $comentarios
        ], 200);
    }

    public static function updateComentario(Request $request, $id) {
        $comentario = Comentario::find($id);
        if ($comentario) {
            $comentario->update($request->all());
            return response()->json([
                'transaction' => true,
                'message' => 'Comentario actualizado',
                'data' => $comentario
            ], 200);
        } else {
            return response()->json([
                'transaction' => false,
                'message' => 'Comentario no encontrado'
            ], 404);
        }
    }

    public static function deleteComentario($id) {
        $comentario = Comentario::find($id);
        if ($comentario) {
            $comentario->delete();
            return response()->json([
                'transaction' => true,
                'message' => 'Comentario eliminado'
            ], 200);
        } else {
            return response()->json([
                'transaction' => false,
                'message' => 'Comentario no encontrado'
            ], 404);
        }
    }
}
