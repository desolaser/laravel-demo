<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempFactura extends Model
{
    protected $table = 'temps_factura';

    protected $fillable = [
        'id_unique', 'factura_id',
    ];

	public function factura()
    {
        return $this->belongsTo(Factura::class);
    }
}
