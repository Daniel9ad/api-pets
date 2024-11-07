<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Storage;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/publicaciones/disponibles', [PublicacionController::class, 'listarMascotasDisponibles']);
Route::get('/publicaciones/images', [PublicacionController::class, 'indeximages']);
Route::post('/subir-imagen', [PublicacionController::class, 'subirImagen']);


Route::apiResource('publicaciones', PublicacionController::class);
Route::apiResource('usuarios', UsuarioController::class);
