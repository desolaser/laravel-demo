<?php

namespace App\Http\Controllers;

use App\{Cotizacion, DetCotizacion, Empresa, Centro, Contacto, Servicio, PrecioEmpresa, Temp,Seguimiento, Nota};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use DB;
use Auth;

class SeguimientoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $user = Auth::user();
        $data = Seguimiento::all();
        return view('seguimiento.index',  [
            'titulo' => 'Seguimiento',
            'role' => $user->role,
            'descripcion' => 'Todas los seguimientos con detalle',
            'data' => $data
        ]);
    }
}
