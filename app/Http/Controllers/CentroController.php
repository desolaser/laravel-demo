<?php

namespace App\Http\Controllers;

use App\{Centro, Empresa, Cotizacion, PrecioEmpresa, Contacto, DetCotizacion};
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DB;

class CentroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Centro::query()
            ->orderBy('nombre')
            ->get();

        return view('centros.index', [
            'centros' => $data,
            'titulo' => 'Listado de centros',
            'descripcion' => 'Centro de cultivos',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresas = Empresa::all(); 
        return view('centros.create', [
            'empresas' => $empresas,
            'titulo' => 'Crear Centro',
            'descripcion' => '',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'empresa_id' => ['required', Rule::in(Empresa::pluck('id'))],
            'nombre' => 'required|string',
            'zona' => 'required|int|nullable',
        ]);

        DB::beginTransaction();
        try {
            $centro = Centro::create([
                'empresa_id' => $data['empresa_id'],
                'nombre' => $data['nombre'],
                'zona' => $data['zona'],
            ]);
            $centro->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect()->route('centros.index')
            ->with('success', 'El centro ha sido registrado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Centro  $centro
     * @return \Illuminate\Http\Response
     */
    public function show(Centro $centro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Centro  $centro
     * @return \Illuminate\Http\Response
     */
    public function edit(Centro $centro)
    {        
        $empresas = Empresa::all(); 
        return view('centros.edit', [
            'empresas' => $empresas,
            'data' => $centro,
            'titulo' => 'Editar Centro',
            'descripcion' => '',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Centro  $centro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Centro $centro)
    {
        $data = $this->validate($request, [
            'empresa_id' => ['required', Rule::in(Empresa::pluck('id'))],
            'nombre' => 'required|string',
            'zona' => 'required|int|nullable|min:0',
        ]);

        $centro->update($data);

        return redirect()->route('centros.index')
            ->with('success', 'El centro ha sido editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Centro  $centro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Centro $centro)
    {
        DB::beginTransaction();
        try {
            $cotizaciones = Cotizacion::where('centro_id', $centro->id)->get();
            foreach ($cotizaciones as $item) {
                $det_cotizaciones = DetCotizacion::where(
                    'cotizacion_id', $item->id)->get();
                foreach ($det_cotizaciones as $ $cot) {
                    $cot->delete();
                }
                $item->delete();
            }
            $contactos = Contacto::where('centro_id', $centro->id)->get();
            foreach ($contactos as $item) {
                $item->delete();
            }
            $centro->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return redirect()->route('centros.index')
            ->with('success', 'El centro ha sido eliminado exitosamente');
    }
}
