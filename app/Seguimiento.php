<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    protected $table = 'seguimiento_cotizaciones';
	protected $fillable = [
		'id', 
		'cotizacion_id',
		'status',
		'usuario'
	];

	public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
	}

}