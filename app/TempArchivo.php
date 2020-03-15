<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempArchivo extends Model
{
    protected $table = 'temps_archivo';
    
    protected $fillable = [
        'id_unique', 'nombre',
    ];
}
