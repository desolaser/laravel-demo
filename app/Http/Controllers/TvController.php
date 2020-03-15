<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tv;
use App\Cotizacion;

class TvController extends Controller
{
    public function show(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $tvs = Tv::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('tv.show', [
                'status' => $status,
                'data' => $tvs
            ]);
        }
    }

    public function store(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            Tv::create($request->all());

            $tv = Tv::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('tv.show', [
                'status' => $status,
                'data' => $tv
            ]);
        }
    }

    public function edit(Request $request)
    {
        if($request->ajax()) {
            $tv = Tv::find($request->id);
            return view('tv.edit', [
                'tv' => $tv
            ]);
        }
    }

    public function update(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $tv = Tv::find($request->id);
            $tv->fill($request->all());
            $tv->save();

            $tv = Tv::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('tv.show', [
                'status' => $status,
                'data' => $tv
            ]);
        }
    }

    public function delete(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $tv = Tv::find($request->id);
            $tv->delete();

            $tv = Tv::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('tv.show', [
                'status' => $status,
                'data' => $tv
            ]);
        }
    }
}
