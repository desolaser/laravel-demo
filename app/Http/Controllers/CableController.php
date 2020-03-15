<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Cable, Cotizacion};

class CableController extends Controller
{
    public function show(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $cables = Cable::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('cable.show', [
                'status' => $status,
                'data' => $cables
            ]);
        }
    }

    public function store(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            Cable::create($request->all());

            $cable = Cable::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('cable.show', [
                'status' => $status,
                'data' => $cable
            ]);
        }
    }

    public function edit(Request $request)
    {
        if($request->ajax()) {
            $cable = Cable::find($request->id);
            return view('cable.edit', [
                'cable' => $cable
            ]);
        }
    }

    public function update(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $cable = Cable::find($request->id);
            $cable->fill($request->all());
            $cable->save();

            $cable = Cable::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('cable.show', [
                'status' => $status,
                'data' => $cable
            ]);
        }
    }

    public function delete(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $cable = Cable::find($request->id);
            $cable->delete();

            $cable = Cable::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('cable.show', [
                'status' => $status,
                'data' => $cable
            ]);
        }
    }
}
