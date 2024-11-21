<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Storage;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/publicaciones/disponibles', [PublicacionController::class, 'listarMascotasDisponibles']);
Route::get('/publicaciones/disponibles/{id_mascota}', [PublicacionController::class, 'filtrarMascotasDisponibles']);
Route::get('/publicaciones/images', [PublicacionController::class, 'indeximages']);
Route::post('/subir-imagen', [PublicacionController::class, 'subirImagen']);
//para ublicacion id
Route::get('/publicacion/{id}', [PublicacionController::class, 'mostrarPublicacion']);


Route::apiResource('publicaciones', PublicacionController::class);
Route::apiResource('usuarios', UsuarioController::class);


// para crear pubicaiones 
Route::post('/crearpublicacion', [PublicacionController::class, 'publicar']);


Route::get('/publicaciones/usuario/{usuario_id}', [PublicacionController::class, 'obtenerPublicacionesPorUsuario']);


Route::put('/publicaciones/{id}/estado', [PublicacionController::class, 'cambiarEstado']);

Route::delete('/publicaciones/{id}', [PublicacionController::class, 'eliminarPublicacion']);


Route::post('/login', [AuthController::class, 'login']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/comentario/comentar', [ComentarioController::class, 'createComentario']);
Route::post('/comentario/responder', [ComentarioController::class, 'createRespuestaComentario']);
Route::get('/comentario/publicacion/{id}', [ComentarioController::class, 'getComentariosPublicacion']);
Route::get('/comentario/usuario/{id}', [ComentarioController::class, 'getComentariosUsuario']);
Route::get('/comentario/{id}', [ComentarioController::class, 'getComentario']);
Route::get('/comentario/{id}/respuestas', [ComentarioController::class, 'getRespuestasComentario']);
Route::put('/comentario/{id}', [ComentarioController::class, 'updateComentario']);
Route::delete('/comentario/{id}', [ComentarioController::class, 'deleteComentario']);

