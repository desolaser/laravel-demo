<?php

namespace App\Http\Controllers;

use App\{Empresa, Cotizacion, Contacto, PrecioEmpresa};
use Illuminate\Http\Request;
use DB;

class EmpresaController extends Controller
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
        $data = Empresa::query()
            ->orderBy('nombre')
            ->get();

        return view('empresas.index', [
            'empresas' => $data,
            'titulo' => 'Listado de empresas',
            'descripcion' => 'Empresas que le prestamos servicios',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empresas.create', [
            'titulo' => 'Crear Empresa',
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
            'nombre' => 'required|string',
            'iniciales' => 'required|string|max:2|unique:empresas',
            'giro' => 'required|string',
            'rut' => 'required|string',
            'razon_social' => 'required|string',
            'direccion' => 'required|string',
            'comuna' => 'required|string',
            'ciudad' => 'required|string',
            'contacto' => 'required|string'
        ]);

        DB::beginTransaction();
        try {
            $empresa = Empresa::create([
                'nombre' => $data['nombre'],
                'iniciales' => $data['iniciales'],
                'giro' => $data['giro'],
                'rut' => $data['rut'],
                'razon_social' => $data['razon_social'],
                'direccion' => $data['direccion'],
                'comuna' => $data['comuna'],
                'ciudad' => $data['ciudad'],
                'contacto' => $data['contacto']
            ]);
            $empresa->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return redirect()->route('empresas.index')
            ->with('success', 'La empresa ha sido registrada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        return view('empresas.edit', [
            'data' => $empresa,
            'titulo' => 'Editar Empresa',
            'descripcion' => '',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresa $empresa)
    {
        $data = $this->validate($request, [
            'nombre' => 'required|string',
            'iniciales' => 'required|string',
            'giro' => 'required|string',
            'rut' => 'required|string',
            'razon_social' => 'required|string',
            'direccion' => 'required|string',
            'comuna' => 'required|string',
            'ciudad' => 'required|string',
            'contacto' => 'required|string'
        ]);

        $empresa->update($data);

        return redirect()->route('empresas.index')
            ->with('success', 'La empresa ha sido editada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        DB::beginTransaction();
        try {
            $cotizaciones = Cotizacion::where('empresa_id', $empresa->id)->get();
            foreach ($cotizaciones as $item) {
                $det_cotizaciones = DetCotizacion::where(
                    'cotizacion_id', $item->id)->get();
                foreach ($det_cotizaciones as $cot) {
                    $cot->delete();
                }
                $item->delete();
            }
            $contactos = Contacto::where('empresa_id', $empresa->id)->get();
            foreach ($contactos as $item) {
                $item->delete();
            }
            $precios = PrecioEmpresa::where('empresa_id', $empresa->id)->get();
            foreach ($precios as $item) {
                $item->delete();
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        $empresa->delete();
        return redirect()->route('empresas.index')
            ->with('success', 'La empresa ha sido eliminada exitosamente');
    }
}
