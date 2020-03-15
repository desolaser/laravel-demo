<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Material, Cotizacion};
use Auth;

class MaterialController extends Controller
{
    public function index($id)
    {
        $status = Cotizacion::find($id)->status;
        return view('materiales.index', [
            'id' => $id,
            'status' => $status,
            'titulo' => 'Materiales',
            'descripcion' => 'Materiales de la cotización: '.$id,
        ]);
    }

    public function show(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $materiales = Material::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('materiales.show', [
                'status' => $status,
                'data' => $materiales
            ]);
        }
    }

    public function edit(Request $request)
    {
        if($request->ajax()) {
            $material = Material::where('id', $request->id)->first();
            return view('materiales.edit', [
                'material' => $material
            ]);
        }
    }

    public function store(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;

            $material = new Material();
            $material->cotizacion_id = $request->cotizacion_id;
            $material->producto = $request->producto;
            $material->cantidad = $request->cantidad;
            $material->proveedor = $request->proveedor;
            $material->p_proveedor = $request->p_proveedor;
            $material->solicitante = Auth::user()->name;
            $material->save();

            $materiales = Material::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('materiales.show', [
                'status' => $status,
                'data' => $materiales
            ]);
        }
    }

    public function update(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;

            $material = Material::where('id', $request->id)->first();
            $material->producto = $request->producto;
            $material->cantidad = $request->cantidad;
            $material->proveedor = $request->proveedor;
            $material->p_proveedor = $request->p_proveedor;
            $material->save();

            $materiales = Material::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('materiales.show', [
                'status' => $status,
                'data' => $materiales
            ]);
        }
    }

    public function delete(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;

            $material = Material::where('id', $request->id)->first();
            $material->delete();

            $materiales = Material::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('materiales.show', [
                'status' => $status,
                'data' => $materiales
            ]);
        }
    }
}
