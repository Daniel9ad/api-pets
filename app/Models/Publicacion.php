<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Publicacion extends Model
{
    protected $table = 'publicaciones';
    protected $fillable = [
        'titulo',
        'descripcion',
        'raza',
        'edad',
        'cantidad_machos',
        'cantidad_hembras',
        'telefono',
        'fecha_publicacion',
        'estado',
        'usuario_id',
        'ciudad_id',
        'especie_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_id');
    }

    public function especie()
    {
        return $this->belongsTo(Especie::class, 'especie_id');
    }

    public function setFechaPublicacionAttribute($value)
    {
        $this->attributes['fecha_publicacion'] = Carbon::now();
    }
}
