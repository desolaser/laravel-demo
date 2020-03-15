<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SwitchRed extends Model
{
    protected $table = 'switch_red';
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
