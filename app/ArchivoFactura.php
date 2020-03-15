<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchivoFactura extends Model
{
    protected $table = 'archivo_facturas';
    protected $fillable = [
        'nombre',        
        'factura_id'
    ];

	public function factura()
    {
        return $this->belongsTo(Factura::class);
	}
}
