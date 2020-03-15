<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Contacto, Empresa, Cotizacion};
use Illuminate\Validation\Rule;
use DB;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Contacto::query()
            ->orderBy('nombre')
            ->get();
        return view('contactos.index', [
            'data' => $data,
            'titulo' => 'Listado de contactos',
            'descripcion' => 'Contactos de empresas',
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
        return view('contactos.create', [
            'empresas' => $empresas,
            'titulo' => 'Crear Contactos',
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
            'nombre' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'zona' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'movil' => 'required|string|max:255',
            'oficina' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $contacto = Contacto::create([
                'empresa_id' => $data['empresa_id'],
                'nombre' => $data['nombre'],
                'cargo' => $data['cargo'],
                'zona' => $data['zona'],
                'email' => $data['email'],
                'movil' => $data['movil'],
                'oficina' => $data['oficina'],
            ]);
            $contacto->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect()->route('contactos.index')
            ->with('success', 'El contacto ha sido registrado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contacto             $contacto
     * @return \Illuminate\Http\Response
     */
    public function edit(Contacto $contacto)
    {
        $empresas = Empresa::all();
        return view('contactos.edit', [
            'empresas' => $empresas,
            'data' => $contacto,
            'titulo' => 'Editar Contacto',
            'descripcion' => '',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contacto             $contacto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contacto $contacto)
    {
        $data = $this->validate($request, [
            'empresa_id' => ['required', Rule::in(Empresa::pluck('id'))],
            'nombre' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'zona' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'movil' => 'required|string|max:255',
            'oficina' => 'required|string|max:255',
        ]);
        $contacto->update($data);
        return redirect()->route('contactos.index')
            ->with('success', 'El contacto ha sido editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contacto             $contacto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacto $contacto)
    {
        DB::beginTransaction();
        try {
            $cotizaciones = Cotizacion::where('contacto_id', $contacto->id)
                ->get();
            foreach ($cotizaciones as $item) {
                $item->delete();
            }
            $contacto->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return redirect()->route('contactos.index')
            ->with('success', 'El contacto ha sido eliminado exitosamente');
    }
}
