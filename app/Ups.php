<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ups extends Model
{
    protected $table = 'ups';
    protected $fillable = [
        'serial',
        'marca',
        'modelo',
        'cotizacion_id'
    ];
    
	public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }
}
