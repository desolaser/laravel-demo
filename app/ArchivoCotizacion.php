<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchivoCotizacion extends Model
{
    protected $table = 'archivo_cotizaciones';
	protected $fillable = ['nombre'];

	public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
	}
}
