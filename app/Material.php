<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materiales';
    protected $fillable = ['producto', 'cantidad', 'proveedor', 'p_proveedor'];
    
	public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }
}
