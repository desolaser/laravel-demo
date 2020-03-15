<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Trabajo, Trabajador, Cotizacion};

class TrabajoController extends Controller
{
    public function index($id)
    {
        $status = Cotizacion::find($id)->status;
        return view('trabajos.index', [
            'id' => $id,
            'status' => $status,
            'titulo' => 'Control de ingreso a la empresa',
            'descripcion' => 'Todos los trabajos realizados en la cotización '.$id,
        ]);
    }

    public function getWorks(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $trabajos = Trabajo::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('trabajos.works', [
                'status' => $status,
                'data' => $trabajos
            ]);
        }
    }

    public function edit(Request $request)
    {
        if($request->ajax()) {
            $trabajo = Trabajo::where('id', $request->id)->first();
            return view('trabajos.edit', [
                'trabajo' => $trabajo
            ]);
        }
    }

    public function store(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;

            $trabajo = new Trabajo();
            $trabajo->cotizacion_id = $request->cotizacion_id;
            $trabajo->motivo = $request->motivo;
            $trabajo->OT = $request->OT;
            $trabajo->GD = $request->GD;
            $trabajo->fecha_ingreso = $request->fecha_ingreso;
            $trabajo->fecha_retorno = $request->fecha_retorno;
            $trabajo->save();

            $trabajos = Trabajo::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('trabajos.works', [
                'status' => $status,
                'data' => $trabajos
            ]);
        }
    }
    public function update(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;

            $trabajo = Trabajo::where('id', $request->id)->first();
            $trabajo->motivo = $request->motivo;
            $trabajo->OT = $request->OT;
            $trabajo->GD = $request->GD;
            $trabajo->fecha_ingreso = $request->fecha_ingreso;
            $trabajo->fecha_retorno = $request->fecha_retorno;
            $trabajo->save();

            $trabajos = Trabajo::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('trabajos.works', [
                'status' => $status,
                'data' => $trabajos
            ]);
        }
    }

    public function delete(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;

            $trabajo = Trabajo::where('id', $request->id)->first();
            $trabajo->delete();

            $trabajos = Trabajo::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('trabajos.works', [
                'status' => $status,
                'data' => $trabajos
            ]);
        }
    }

    public function workers(Request $request)
    {
        if($request->ajax()) {
            $trabajadores = Trabajador::all();
            $trabajo = Trabajo::where('id', $request->id)->first();
            return view('trabajos.workers', [
                'trabajadores' => $trabajadores,
                'trabajo' => $trabajo,
            ]);
        }
    }

    public function addWorker(Request $request)
    {
        if($request->ajax()) {
            $trabajo = Trabajo::find($request->id);
            $trabajador = Trabajador::find($request->trabajador_id);
            $trabajo->trabajadores()->attach($trabajador);

            $trabajadores = Trabajador::all();
            return view('trabajos.workers', [
                'trabajadores' => $trabajadores,
                'trabajo' => $trabajo,
            ]);
        }
    }

    public function deleteWorker(Request $request)
    {
        if($request->ajax()) {
            $trabajo = Trabajo::find($request->id);
            $trabajo->trabajadores()->detach($request->trabajador_id);

            $trabajadores = Trabajador::all();
            return view('trabajos.workers', [
                'trabajadores' => $trabajadores,
                'trabajo' => $trabajo
            ]);
        }
    }
}
