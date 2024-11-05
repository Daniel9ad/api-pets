<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    protected $fillable = [
        'id_usuario',
        'id_mascota',
        'titulo',
        'descripcion',
        'tipo_publicacion',
        'fecha_publicacion',
        'estado',
    ];
    // public function usuario()
    // {
    //     return $this->belongsTo(Usuario::class, 'id_usuario');
    // }

    // public function mascota()
    // {
    //     return $this->hasOne(Mascota::class, 'id_mascota');
    // }

    // public function imagenes()
    // {
    //     return $this->hasMany(ImagenMascota::class, 'id_publicacion');
    // }
}
