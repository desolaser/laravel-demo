<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Regulador;
use App\Cotizacion;

class ReguladorController extends Controller
{
    public function show(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $reguladores = Regulador::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('regulador.show', [
                'status' => $status,
                'data' => $reguladores
            ]);
        }
    }

    public function store(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            Regulador::create($request->all());

            $reguladores = Regulador::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('regulador.show', [
                'status' => $status,
                'data' => $reguladores
            ]);
        }
    }

    public function edit(Request $request)
    {
        if($request->ajax()) {
            $regulador = Regulador::find($request->id);
            return view('regulador.edit', [
                'regulador' => $regulador
            ]);
        }
    }

    public function update(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $regulador = Regulador::find($request->id);
            $regulador->fill($request->all());
            $regulador->save();

            $reguladores = Regulador::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('regulador.show', [
                'status' => $status,
                'data' => $reguladores
            ]);
        }
    }

    public function delete(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $regulador = Regulador::find($request->id);
            $regulador->delete();

            $reguladores = Regulador::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('regulador.show', [
                'status' => $status,
                'data' => $reguladores
            ]);
        }
    }
}
