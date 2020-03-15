<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Gasto, Trabajo, Cotizacion};

class GastosController extends Controller
{
    public function index($id)
    {
        $status = Cotizacion::find($id)->status;
        $trabajos = Trabajo::where('cotizacion_id', $id)->get();
        return view('gastos.index', [
            'id' => $id,
            'status' => $status,
            'titulo' => 'Gastos de operación en terreno',
            'descripcion' => 'Todos los gastos relacionados a los trabajos de la cotización '.$id,
            'trabajos' => $trabajos
        ]);
    }

    public function show(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $trabajos = Trabajo::where('cotizacion_id', $request->cotizacion_id)->get();
            $data = array();
            foreach($trabajos as $item) {
                $gastos = Gasto::where('trabajo_id', $item->id)->get();
                array_push($data, $gastos);
            }
            return view('gastos.show', [
                'data' => $data,
                'status' => $status,
                'trabajos' => $trabajos,
            ]);
        }
    }

    public function edit(Request $request)
    {
        if($request->ajax()) {
            $gasto = Gasto::where('id', $request->id)->first();
            return view('gastos.edit', [
                'gasto' => $gasto
            ]);
        }
    }

    public function store(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;

            $gasto = new Gasto();
            $gasto->trabajo_id = $request->trabajo_id;
            $gasto->nombre = $request->nombre;
            $gasto->gasto = $request->gasto;
            $gasto->numero_boleta = $request->numero_boleta;
            $gasto->tipo = $request->tipo;
            $gasto->fecha = $request->fecha;
            $gasto->save();

            $trabajos = Trabajo::where('cotizacion_id', $request->cotizacion_id)->get();
            $data = array();
            foreach($trabajos as $item) {
                $gastos = Gasto::where('trabajo_id', $item->id)->get();
                array_push($data, $gastos);
            }
            return view('gastos.show', [
                'data' => $data,
                'status' => $status,
                'trabajos' => $trabajos,
            ]);
        }
    }

    public function update(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;

            $gasto = Gasto::where('id', $request->id)->first();
            $gasto->nombre = $request->nombre;
            $gasto->gasto = $request->gasto;
            $gasto->numero_boleta = $request->numero_boleta;
            $gasto->tipo = $request->tipo;
            $gasto->fecha = $request->fecha;
            $gasto->save();

            $trabajos = Trabajo::where('cotizacion_id', $request->cotizacion_id)->get();
            $data = array();
            foreach($trabajos as $item) {
                $gastos = Gasto::where('trabajo_id', $item->id)->get();
                array_push($data, $gastos);
            }
            return view('gastos.show', [
                'data' => $data,
                'status' => $status,
                'trabajos' => $trabajos,
            ]);
        }
    }

    public function delete(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;

            $gasto = Gasto::where('id', $request->id)->first();
            $gasto->delete();

            $trabajos = Trabajo::where('cotizacion_id', $request->cotizacion_id)->get();
            $data = array();
            foreach($trabajos as $item) {
                $gastos = Gasto::where('trabajo_id', $item->id)->get();
                array_push($data, $gastos);
            }
            return view('gastos.show', [
                'data' => $data,
                'status' => $status,
                'trabajos' => $trabajos,
            ]);
        }
    }
}
