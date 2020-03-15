<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pc extends Model
{
    protected $table = 'pc';
    protected $fillable = [
        'modelo',
        'serial',
        'tipo',
        'placa_madre',
        'fuente_poder',
        'procesador',
        'teclado',
        'mouse',
        'ram',
        'disco_duro',
        'tarjeta_video',
        'wifi',
        'cotizacion_id'
    ];
    
	public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }
}
