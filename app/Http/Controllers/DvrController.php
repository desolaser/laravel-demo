<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Dvr, Cotizacion};

class DvrController extends Controller
{
    public function show(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $dvrs = Dvr::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('dvr.show', [
                'status' => $status,
                'data' => $dvrs
            ]);
        }
    }

    public function store(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            Dvr::create($request->all());

            $dvrs = Dvr::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('dvr.show', [
                'status' => $status,
                'data' => $dvrs
            ]);
        }
    }

    public function edit(Request $request)
    {
        if($request->ajax()) {
            $dvr = Dvr::find($request->id);
            return view('dvr.edit', [
                'dvr' => $dvr
            ]);
        }
    }

    public function update(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $dvr = Dvr::find($request->id);
            $dvr->fill($request->all());
            $dvr->save();

            $dvrs = Dvr::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('dvr.show', [
                'status' => $status,
                'data' => $dvrs
            ]);
        }
    }

    public function delete(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $dvr = Dvr::find($request->id);
            $dvr->delete();

            $dvrs = Dvr::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('dvr.show', [
                'status' => $status,
                'data' => $dvrs
            ]);
        }
    }
}
