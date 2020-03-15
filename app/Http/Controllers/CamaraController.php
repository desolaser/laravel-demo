<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Camara, Cotizacion};

class CamaraController extends Controller
{
    public function show(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $camaras = Camara::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('camara.show', [
                'status' => $status,
                'data' => $camaras
            ]);
        }
    }

    public function store(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            Camara::create($request->all());

            $camaras = Camara::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('camara.show', [
                'status' => $status,
                'data' => $camaras
            ]);
        }
    }

    public function edit(Request $request)
    {
        if($request->ajax()) {
            $camara = Camara::find($request->id);
            return view('camara.edit', [
                'camara' => $camara
            ]);
        }
    }

    public function update(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $camara = Camara::find($request->id);
            $camara->fill($request->all());
            $camara->save();

            $camaras = Camara::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('camara.show', [
                'status' => $status,
                'data' => $camaras
            ]);
        }
    }

    public function delete(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $camara = Camara::find($request->id);
            $camara->delete();

            $camaras = Camara::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('camara.show', [
                'status' => $status,
                'data' => $camaras
            ]);
        }
    }
}
