<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    protected $fillable = [
        'nombre', 'rut',
    ];    
    
	public function trabajos()
    {
        return $this->belongsToMany(Trabajo::class);
	}
}