<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//add
use Illuminate\Http\Request;
use App\Servicio;


class Servicio extends Model
{
    protected $fillable = ['nombre'];

	public function productos()
    {
        return $this->hasMany(Producto::class);
    }

}
