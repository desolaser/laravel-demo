<?php

namespace App\Http\Controllers;

use App\{Producto, Servicio, Categoria, Empresa, PrecioEmpresa};
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ProductoController extends Controller
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
        $data = Producto::query()
            ->where('archivado', 'FALSE')
            ->orderBy('servicio_id')
            ->orderBy('categoria_id')
            ->orderBy('nombre')
            ->get();
            
        return view('productos.index', [
            'data' => $data,
            'titulo' => 'Listado de Productos',
            'descripcion' => 'Productos que ofrece Microwave SpA',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servicios = Servicio::all();
        $categorias = Categoria::all();

        return view('productos.create', [
            'servicios' => $servicios,
            'categorias' => $categorias,
            'titulo' => 'Crear Producto',
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
            'servicio_id' => ['required', Rule::in(Servicio::pluck('id'))],
            'categoria_id' => ['required', Rule::in(Categoria::pluck('id'))],
            'nombre' => 'required',
            'unidad' => ['required', Rule::in(['MONTO', 'UNIDAD', 'METROS'])],
            'precio' => 'required|integer'
        ]);

        $producto = Producto::create([
            'servicio_id' => $data['servicio_id'],
            'categoria_id' => $data['categoria_id'],
            'nombre' => $data['nombre'],
            'unidad' => $data['unidad'],
            'precio' => $data['precio'],
        ]);

        $empresas = Empresa::all();

        foreach ($empresas as $empresa) {
            $PrecioEmpresa = new PrecioEmpresa();

            $PrecioEmpresa->empresa_id = $empresa->id;
            $PrecioEmpresa->servicio_id = $producto->servicio_id;
            $PrecioEmpresa->producto_id = $producto->id;
            $PrecioEmpresa->precio = $producto->precio;
            $PrecioEmpresa->save();
        }

        return redirect()->route('productos.index')
            ->with('success', 'El producto ha sido registrado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        $servicios = Servicio::all();
        $categorias = Categoria::all();

        return view('productos.edit', [
            'data' => $producto,
            'servicios' => $servicios,
            'categorias' => $categorias,
            'origen'=> 'Producto',
            'titulo' => 'Editar Producto',
            'descripcion' => '',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $origen = $request['origen'];
        $data = $this->validate($request, [
            'servicio_id' => ['required', Rule::in(Servicio::pluck('id'))],
            'categoria_id' => ['required', Rule::in(Categoria::pluck('id'))],
            'nombre' => 'required',
            'unidad' => ['required', Rule::in(['MONTO', 'UNIDAD', 'METROS'])],
            'precio' => 'required|min:0'
        ]);

        $producto->update($data);

        $precios_empresa = PrecioEmpresa::where('producto_id', $producto->id)->get();
        foreach($precios_empresa as $item) {
            $item->precio = $request['precio'];
            $item->save();
        }

        if ($origen == 'Producto') {
            return redirect()->route('productos.index')
                ->with('success', 'El producto ha sido editado exitosamente');
        }
        else {
            return redirect()->route('precios.index')
                ->with('success', 'El producto ha sido editado exitosamente');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->archivado = 'TRUE';
        $producto->save();
        
        $precios_empresa = PrecioEmpresa::where('producto_id', $producto->id)->get();
        foreach($precios_empresa as $item) {
            $item->delete();
        }

        return redirect()->route('productos.index')
            ->with('success', 'El producto ha sido archivado exitosamente');
    }
}
