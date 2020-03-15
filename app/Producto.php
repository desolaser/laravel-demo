<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'servicio_id', 'categoria_id', 'nombre', 'unidad', 'precio'
    ];
    
    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
