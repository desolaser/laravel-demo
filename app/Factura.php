<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'facturas';
    protected $fillable = [
        'transferencia_id',
        'rut',
        'razon_social',
        'fecha',
        'resumen',
        'monto',
        'numero_factura_sii',
    ];

	public function cotizaciones()
    {
        return $this->hasMany(Cotizacion::class);
    }

    public function archivos()
    {
        return $this->hasMany(ArchivoFactura::class);
    }

    public function transferencia()
    {
        return $this->belongsTo(Transferencia::class);
    }
}
