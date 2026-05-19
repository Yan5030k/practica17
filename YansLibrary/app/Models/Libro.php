<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $fillable = [
        'nombre',
        'autor',
        'editorial',
        'edicion',
        'fecha_lanzamiento',
        'imagen_portada',
        'categoria_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}