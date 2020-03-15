<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetCotizacion extends Model
{
    protected $table = 'det_cotizaciones';
    protected $fillable = ['cotizacion_id', 'servicio_id', 'producto_id', 'cantidad', 'precio', 'total'];

	public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }

	public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

	public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}

