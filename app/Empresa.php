<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
        'nombre',
        'iniciales',
        'giro',
        'rut',
        'razon_social',
        'direccion',
        'comuna',
        'ciudad',
        'contacto',
    ];

	public function centros()
    {
        return $this->hasMany(Centro::class);
    }

    public function precioEmpresa()
    {
        return $this->hasMany(precioEmpresa::class);
    }
}
