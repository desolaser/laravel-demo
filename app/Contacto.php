<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $fillable = [
        'empresa_id',
        'centro_id',
        'nombre',
        'cargo',
        'zona',
        'email',
        'movil',
        'oficina'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

	public function centro()
    {
        return $this->belongsTo(Centro::class);
	}
}
