<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Cotizacion};

class DatosTecnicosController extends Controller
{
    public function index($id)
    {
        $status = Cotizacion::find($id)->status;
        return view('datos_tecnicos.index', [
            'id' => $id,
            'status' => $status,
            'titulo' => 'Visualización de datos técnicos',
            'descripcion' => 'Todos los datos técnicos asociados a la cotización '.$id,
        ]);
    }
}
