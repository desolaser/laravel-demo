<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Broadcast, Cotizacion};

class BroadcastController extends Controller
{
    public function show(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $broadcasts = Broadcast::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('broadcast.show', [
                'status' => $status,
                'data' => $broadcasts
            ]);
        }
    }

    public function store(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            Broadcast::create($request->all());

            $broadcasts = Broadcast::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('broadcast.show', [
                'status' => $status,
                'data' => $broadcasts
            ]);
        }
    }

    public function edit(Request $request)
    {
        if($request->ajax()) {
            $broadcast = Broadcast::find($request->id);
            return view('broadcast.edit', [
                'broadcast' => $broadcast
            ]);
        }
    }

    public function update(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $broadcast = Broadcast::find($request->id);
            $broadcast->fill($request->all());
            $broadcast->save();

            $broadcasts = Broadcast::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('broadcast.show', [
                'status' => $status,
                'data' => $broadcasts
            ]);
        }
    }

    public function delete(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $broadcast = Broadcast::find($request->id);
            $broadcast->delete();

            $broadcasts = Broadcast::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('broadcast.show', [
                'status' => $status,
                'data' => $broadcasts
            ]);
        }
    }
}
