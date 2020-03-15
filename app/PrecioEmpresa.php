<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrecioEmpresa extends Model
{
    protected $table = 'precios_empresas';

    protected $fillable = [
        'id', 'precio',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
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
