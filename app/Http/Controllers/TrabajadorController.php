<?php

namespace App\Http\Controllers;

use App\{Trabajador};
use Illuminate\Http\Request;
use DB;

class TrabajadorController extends Controller
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
        $data = Trabajador::all();

        return view('trabajadores.index', [
            'trabajadores' => $data,
            'titulo' => 'Listado de trabajadores',
            'descripcion' => 'Trabajadores para la sección operaciones',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trabajadores.create', [
            'titulo' => 'Crear nuevo trabajador',
            'descripcion' => 'Trabajadores para la sección operaciones',
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
            'nombre' => 'required',
            'rut' => 'required',
        ]);

        $trabajadores = Trabajador::create([
            'nombre' => $data['nombre'],
            'rut' => $data['rut']
        ]);

        return redirect()->route('trabajadores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function show(Trabajador $trabajador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trabajador = Trabajador::find($id);
        return view('trabajadores.edit', [
            'trabajador' => $trabajador,
            'titulo' => 'Editar trabajador',
            'descripcion' => 'Trabajadores para la sección operaciones',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $trabajador = Trabajador::find($id);
        $data = $this->validate($request, [
            'nombre' => 'required',
            'rut' => 'required',
        ]);

        $trabajador->update($data);

        return redirect()->route('trabajadores.index');
    }

   
    public function destroy($id)
    {
        $trabajador = Trabajador::find($id);
        DB::beginTransaction();
        try {
            $trabajador->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return redirect()->route('trabajadores.index');
    }
}
