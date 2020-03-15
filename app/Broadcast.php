<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Broadcast extends Model
{
    protected $table = 'broadcast';
    protected $fillable = [
        'serial',
        'modelo',
        'usuario',
        'clave',
        'serial_p2p',
        'ip',
        'mac_address',
        'nombre',
        'firmware',
        'backup',
        'marca_dvr',
        'modelo_dvr',
        'numero_produccion',
        'numero_camaras',
        'cotizacion_id'
    ];

	public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }
}
