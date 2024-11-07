<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    /** @use HasFactory<\Database\Factories\CiudadFactory> */
    use HasFactory;
    protected $table = 'ciudades';
    protected $fillable = [
        'id',
        'nombre'
    ];
}
