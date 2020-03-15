<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ap extends Model
{
    protected $table = 'ap';
    protected $fillable = [
        'serial',
        'marca',
        'modelo',
        'usuario',
        'clave',
        'ssid',
        'wifi',
        'ip',
        'firmware',
        'backup',
        'tipo',
        'tipo_equipo',
        'cotizacion_id'
    ];

	public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }
}
