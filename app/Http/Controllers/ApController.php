<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Ap, Cotizacion};

class ApController extends Controller
{
    public function show(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;

            $aps = Ap::where('cotizacion_id', $request->cotizacion_id)
                ->where('tipo_equipo', 'PONTON')
                ->get();
            return view('ap.show', [
                'status' => $status,
                'data' => $aps
            ]);
        }
    }

    public function show_modulo(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;

            $aps = Ap::where('cotizacion_id', $request->cotizacion_id)
                ->where('tipo_equipo', 'MODULO')
                ->get();
            return view('ap.show-modulo', [
                'status' => $status,
                'data' => $aps
            ]);
        }
    }

    public function store(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;

            Ap::create($request->all());

            $aps = Ap::where('cotizacion_id', $request->cotizacion_id)
                ->where('tipo_equipo', 'PONTON')
                ->get();
            return view('ap.show', [
                'status' => $status,
                'data' => $aps
            ]);
        }
    }

    public function store_modulo(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;

            Ap::create($request->all());

            $aps = Ap::where('cotizacion_id', $request->cotizacion_id)
                ->where('tipo_equipo', 'MODULO')
                ->get();
            return view('ap.show-modulo', [
                'status' => $status,
                'data' => $aps
            ]);
        }
    }

    public function edit(Request $request)
    {
        if($request->ajax()) {
            $ap = Ap::find($request->id);
            return view('ap.edit', [
                'ap' => $ap
            ]);
        }
    }

    public function edit_modulo(Request $request)
    {
        if($request->ajax()) {
            $ap = Ap::find($request->id);
            return view('ap.edit-modulo', [
                'ap' => $ap
            ]);
        }
    }

    public function update(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;

            $ap = Ap::find($request->id);
            $ap->fill($request->all());
            $ap->save();

            $aps = Ap::where('cotizacion_id', $request->cotizacion_id)
                ->where('tipo_equipo', 'PONTON')
                ->get();
            return view('ap.show', [
                'status' => $status,
                'data' => $aps
            ]);
        }
    }

    public function update_modulo(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;

            $ap = Ap::find($request->id);
            $ap->fill($request->all());
            $ap->save();

            $aps = Ap::where('cotizacion_id', $request->cotizacion_id)
                ->where('tipo_equipo', 'MÓDULO')
                ->get();
            return view('ap.show-modulo', [
                'status' => $status,
                'data' => $aps
            ]);
        }
    }

    public function delete(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;

            $ap = Ap::find($request->id);
            $ap->delete();

            $aps = Ap::where('cotizacion_id', $request->cotizacion_id)
                ->where('tipo_equipo', 'PONTON')
                ->get();
            return view('ap.show', [
                'status' => $status,
                'data' => $aps
            ]);
        }
    }

    public function delete_modulo(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;

            $ap = Ap::find($request->id);
            $ap->delete();

            $aps = Ap::where('cotizacion_id', $request->cotizacion_id)
                ->where('tipo_equipo', 'MODULO')
                ->get();
            return view('ap.show-modulo', [
                'status' => $status,
                'data' => $aps
            ]);
        }
    }
}
