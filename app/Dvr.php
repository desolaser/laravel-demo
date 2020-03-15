<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dvr extends Model
{
    protected $table = 'dvr';
    protected $fillable = [
        'serial',
        'marca',
        'modelo',
        'cotizacion_id'
    ];

	public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }
}
