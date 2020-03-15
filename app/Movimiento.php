<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $table = 'movimientos';
    protected $fillable = [
        'fecha',
        'monto',
        'saldo',
        'empresa_id',
        'factura_id',
        'transferencia_id'
    ];

	  public function empresa()
    {
        return $this->belongsTo(Empresa::class);
	  }

	  public function factura()
    {
        return $this->hasOne(Factura::class);
	  }

	  public function transferencia()
    {
        return $this->hasOne(Transferencia::class);
	  }
}
