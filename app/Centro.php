<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Centro extends Model
{
    protected $fillable = [
        'empresa_id', 'nombre', 'zona'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
