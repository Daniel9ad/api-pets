<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'comentarios';

    protected $fillable = [
        'comentario',
        'calificacion',
        'fecha',
        'id_usuario',
        'id_publicacion',
        'id_comentario_padre'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function publicacion()
    {
        return $this->belongsTo(Publicacion::class, 'id_publicacion');
    }

    public function comentarioPadre()
    {
        return $this->belongsTo(Comentario::class, 'id_comentario_padre');
    }

    public function comentariosHijos()
    {
        return $this->hasMany(Comentario::class, 'id_comentario_padre');
    }
}