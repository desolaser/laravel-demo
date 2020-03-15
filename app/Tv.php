<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tv extends Model
{
    protected $table = 'tv';
    protected $fillable = [
        'marca',
        'modelo',
        'serial',
        'dimension',
        'formato',
        'cotizacion_id'
    ];
    
	public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }
}
