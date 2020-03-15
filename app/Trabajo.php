<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    protected $table = 'trabajos';
    protected $fillable = ['motivo', 'OT', 'GD', 'fecha_ingreso', 'fecha_retorno'];

	public function trabajadores()
    {
        return $this->belongsToMany(Trabajador::class);
    }
}
