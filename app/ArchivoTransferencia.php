<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchivoTransferencia extends Model
{
    protected $table = 'archivo_transferencias';
    protected $fillable = [
        'nombre',
        'transferencia_id'
    ];

	public function transferencia()
    {
        return $this->belongsTo(Transferencia::class);
	}
}
