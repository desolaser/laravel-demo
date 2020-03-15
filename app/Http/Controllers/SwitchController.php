<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SwitchRed;
use App\Cotizacion;

class SwitchController extends Controller
{
    public function show(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $switchs = SwitchRed::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('switch.show', [
                'status' => $status,
                'data' => $switchs
            ]);
        }
    }

    public function store(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            SwitchRed::create($request->all());

            $switchs = SwitchRed::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('switch.show', [
                'status' => $status,
                'data' => $switchs
            ]);
        }
    }

    public function edit(Request $request)
    {
        if($request->ajax()) {
            $switch = SwitchRed::find($request->id);
            return view('switch.edit', [
                'switch' => $switch
            ]);
        }
    }

    public function update(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $switch = SwitchRed::find($request->id);
            $switch->fill($request->all());
            $switch->save();

            $switchs = SwitchRed::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('switch.show', [
                'status' => $status,
                'data' => $switchs
            ]);
        }
    }

    public function delete(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $switch = SwitchRed::find($request->id);
            $switch->delete();

            $switchs = SwitchRed::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('switch.show', [
                'status' => $status,
                'data' => $switchs
            ]);
        }
    }
}
