<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cable extends Model
{
    protected $table = 'cable';
    protected $fillable = [
        'tipo_cable',
        'longitud',
        'cantidad',
        'cotizacion_id'
    ];

	public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }
}
