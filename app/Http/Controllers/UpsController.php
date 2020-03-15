<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ups;
use App\Cotizacion;

class UpsController extends Controller
{
    public function show(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $upss = Ups::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('ups.show', [
                'status' => $status,
                'data' => $upss
            ]);
        }
    }

    public function store(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            Ups::create($request->all());

            $upss = Ups::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('ups.show', [
                'status' => $status,
                'data' => $upss
            ]);
        }
    }

    public function edit(Request $request)
    {
        if($request->ajax()) {
            $ups = Ups::find($request->id);
            return view('ups.edit', [
                'ups' => $ups
            ]);
        }
    }

    public function update(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $ups = Ups::find($request->id);
            $ups->fill($request->all());
            $ups->save();

            $upss = Ups::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('ups.show', [
                'status' => $status,
                'data' => $upss
            ]);
        }
    }

    public function delete(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $ups = Ups::find($request->id);
            $ups->delete();

            $upss = Ups::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('ups.show', [
                'status' => $status,
                'data' => $upss
            ]);
        }
    }
}
