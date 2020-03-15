<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Camara extends Model
{
    protected $table = 'camara';
    protected $fillable = [
        'serial',
        'marca',
        'modelo',
        'usuario',
        'clave',
        'serial_p2p',
        'ip',
        'mac_address',
        'nombre',
        'firmware',
        'backup',
        'cotizacion_id'
    ];

	public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }
}
