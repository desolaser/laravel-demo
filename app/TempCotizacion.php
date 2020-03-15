<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempCotizacion extends Model
{
    protected $table = 'temps_cotizacion';
    
    protected $fillable = [
        'id_unique', 'cotizacion_id',
    ];

	public function cotizacion() 
    {
        return $this->belongsTo(Cotizaciones::class);
    }
}
