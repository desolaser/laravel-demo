<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pc;
use App\Cotizacion;

class PcController extends Controller
{
    public function show(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $pcs = Pc::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('pc.show', [
                'status' => $status,
                'data' => $pcs
            ]);
        }
    }

    public function store(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            Pc::create($request->all());

            $pc = Pc::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('pc.show', [
                'status' => $status,
                'data' => $pc
            ]);
        }
    }

    public function edit(Request $request)
    {
        if($request->ajax()) {
            $pc = Pc::find($request->id);
            return view('pc.edit', [
                'pc' => $pc
            ]);
        }
    }

    public function update(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $pc = Pc::find($request->id);
            $pc->fill($request->all());
            $pc->save();

            $pc = Pc::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('pc.show', [
                'status' => $status,
                'data' => $pc
            ]);
        }
    }

    public function delete(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $pc = Pc::find($request->id);
            $pc->delete();

            $pc = Pc::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('pc.show', [
                'status' => $status,
                'data' => $pc
            ]);
        }
    }
}
