<?php

namespace App\Http\Controllers;

use App\{Cotizacion,Seguimiento};
use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Auth;
use Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $estados_validos = [
            'EN_DISEÑO',
            'EN_VALIDACIÓN',
            'POR_ENVIAR',
            'EVALUACIÓN_CLIENTE'
        ];
        $data = Cotizacion::whereIn('status', $estados_validos)->get();
        return view('admin.dashboard', [
            'titulo' => '',
            'descripcion' => '',
            'role' => $user->role,
            'data' => $data
        ]);
    }

    public function getDashboardData()
    {
        $user = Auth::user();
        $cotizaciones = Cotizacion::all();
        $data = array();
        $i = 0;
        foreach ($cotizaciones as $item) {
            $data[$i]['id'] = $item->id;
            $data[$i]['status'] = $item->status;
            $data[$i]['fecha_ingreso'] = $item->created_at->toDateString();
            $data[$i]['empresa'] = $item->empresa->nombre;
            $data[$i]['role'] = $user->role;
            $i++;
        }
        return Response::json($data);
    }

    public function sendToAdmin($id)
    {
        $user = Auth::user();
        $aprobador = $user->name;
        $cotizacion = Cotizacion::where('id', $id)->first();
        $cotizacion->status = 'EN_VALIDACIÓN';
        $cotizacion->save();
        return redirect('/');
    }

    public function aprove($id)
    {
        $user = Auth::user();
        $aprobador = $user->name;
        $cotizacion = Cotizacion::where('id', $id)->first();
        $cotizacion->status = 'POR_ENVIAR';
        $cotizacion->save();
        return redirect('/');
    }

    public function cancel($id)
    {
        $user = Auth::user();
        $aprobador = $user->name;
        $cotizacion = Cotizacion::where('id', $id)->first();
        $cotizacion->status = 'ANULADO-INTERNO';
        $cotizacion->save();
        return redirect('/');
    }

    public function reject($id)
    {
        $user = Auth::user();
        $aprobador = $user->name;
        $cotizacion = Cotizacion::where('id', $id)->first();
        $cotizacion->status = 'RECHAZADO-EXTERNO';
        $cotizacion->save();
        return redirect('/');
    }

    public function operations($id)
    {
        $user = Auth::user();
        $aprobador = $user->name;
        $cotizacion = Cotizacion::where('id', $id)->first();
        $cotizacion->status = 'FACTURACIÓN';
        $cotizacion->save();
        return redirect('/');
    }
}
