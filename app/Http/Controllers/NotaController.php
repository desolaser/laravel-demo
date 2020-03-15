<?php

namespace App\Http\Controllers;

use App\Nota;
use Illuminate\Http\Request;
use DB;

class NotaController extends Controller
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
        $data = Nota::all();

        return view('notas.index', [
            'notas' => $data,
            'titulo' => 'Listado de notas',
            'descripcion' => 'Notas predefinidas para la cotización',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notas.create', [
            'titulo' => 'Crear nueva nota',
            'descripcion' => 'Notas predefinidas para la cotización',
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
            'detalle' => 'required',
        ]);

        $notas = Nota::create([
            'detalle' => $data['detalle']
        ]);

        return redirect()->route('notas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function show(Nota $nota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function edit(Nota $nota)
    {
        return view('notas.edit', [
            'nota' => $nota,
            'titulo' => 'Editar nota',
            'descripcion' => 'Notas predefinidas para la cotización',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nota $nota)
    {
        $data = $this->validate($request, [
            'detalle' => 'required',
        ]);

        $nota->update($data);

        return redirect()->route('notas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nota $nota)
    {
        DB::beginTransaction();
        try {
            $nota->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return redirect()->route('notas.index');
    }
}
