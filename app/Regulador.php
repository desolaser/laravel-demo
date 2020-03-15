<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regulador extends Model
{
    protected $table = 'regulador';
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
