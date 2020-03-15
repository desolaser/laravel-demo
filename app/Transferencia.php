<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transferencia extends Model
{
    protected $table = 'transferencias';
    protected $fillable = [
        'tipo_pago',
        'monto',
        'fecha',
        'banco',
        'numero_cheque',
        'nombre_banco',
        'codigo_transferencia',
    ];

	public function archivos()
    {
        return $this->hasMany(ArchivoTransferencia::class);
    }

	public function factura()
    {
        return $this->hasMany(Factura::class);
    }
}
