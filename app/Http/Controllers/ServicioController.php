<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicio;
use DB;

class ServicioController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Servicio::query()
            ->withCount('productos')
            ->orderBy('nombre')
            ->get();
            
        return view('servicios.index', [
            'data' => $data,
            'titulo' => 'Listado de servicios',
            'descripcion' => 'Servicios que ofrece Microwave SpA',
        ]);
    }


    public function prueba()
    {            
        return view('servicios.prueba', [
            'titulo' => 'Listado de servicio',
            'descripcion' => 'Servicios que ofrece Microwave SpA',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('servicios.create', [
            'titulo' => 'Crear Servicio',
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
            'nombre' => 'required|string'
        ]);

        DB::beginTransaction();
        try {
            $servicio = Servicio::create([
                'nombre' => $data['nombre']
            ]);
            $servicio->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect()->route('servicios.index')
            ->with('success', 'El servicio ha sido registrado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function show(Servicio $servicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function edit(Servicio $servicio)
    {
        return view('servicios.edit', [
            'data' => $servicio,
            'titulo' => 'Editar Empresa',
            'descripcion' => '',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servicio $servicio)
    {                
        $data = $this->validate($request, [
            'nombre' => 'required|string'
        ]);

        $servicio->update($data);

        return redirect()->route('servicios.index')
            ->with('success', 'El servicio ha sido editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servicio $servicio)
    {
        DB::beginTransaction();
        try {
            $productos = Contacto::where('servicio_id', $servicio->id)->get();
            foreach ($productos as $item) {
                $item->delete();
            }            
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        $servicio->delete();
        return redirect()->route('servicios.index')
            ->with('success', 'El servicio ha sido borrado exitosamente');
    }
}
