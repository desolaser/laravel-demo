<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
  protected $table = 'cotizaciones';
	protected $fillable = [
		'empresa_id',
		'contacto_id',
		'factura_id',
		'nota',
		'viatico',
		'subtotal',
		'impuesto',
		'total'
	];

	public function empresa()
  {
      return $this->belongsTo(Empresa::class);
	}

	public function contacto()
  {
      return $this->belongsTo(Contacto::class);
  }

	public function factura()
  {
      return $this->belongsTo(Factura::class);
  }
}
