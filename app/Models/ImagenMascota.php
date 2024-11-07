<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Publicacion;

class ImagenMascota extends Model
{
    //
    protected $table = 'imagen_mascotas';
    protected $fillable = [
        'id_publicacion',
        'urlIMG',
    ];
    public function publicacion()
    {
        return $this->belongsTo(Publicacion::class, 'id_publicacion');
    }
    
}
