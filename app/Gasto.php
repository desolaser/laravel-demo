<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    protected $table = 'gastos';
    protected $fillable = ['nombre', 'gasto', 'numero_boleta', 'tipo', 'fecha'];

	public function trabajo()
    {
        return $this->belongsTo(Trabajo::class);
    }
}
