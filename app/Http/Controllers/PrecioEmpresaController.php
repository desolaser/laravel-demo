<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// add
use App\{PrecioEmpresa, Empresa, Producto, Servicio, Categoria};
use App\Http\Requests\UpdatePrecioEmpresaRequest;
use Auth;

//use Illuminate\Support\Facades\DB;
//use Illuminate\Validation\Rule;

class PrecioEmpresaController extends Controller
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
        $empresas = Empresa::all();
        
        $productos = Producto::query()
            ->orderBy('servicio_id')
            ->get();

        //Encabezado
        $th  = array();
        
        $th[0] = 'Servicio';
        $th[1] = 'Categoria';
        $th[2] = 'Producto';
        $th[3] = 'Precio';
        $th[4] = 'Unidad';

        //Empresas
        $c = 5;
        foreach ($empresas as $items) {
            $th[$c] = $items->nombre;
            $c++;
        } 

        //Tabulador de Precios
        $tabulador  = array();

        //Productos
        $i = 0;
        foreach ($productos as $item) {
            $tabulador[$i][0] = $item->servicio->nombre;
            $tabulador[$i][1] = $item->categoria->nombre;
            $tabulador[$i][2] = $item->nombre;
            $tabulador[$i][3] = number_format($item->precio);
            $tabulador[$i][4] = $item->unidad;
            $tabulador[$i][5] = $item->id;
            $c = 6;
            foreach ($empresas as $empresa) {
                $reg = PrecioEmpresa::where([
                        ['empresa_id', '=', $empresa->id],
                        ['producto_id', '=', $item->id]
                    ])->first();
                $tabulador[$i][$c] = number_format($reg->precio) . ';' . $reg->id;
                $c++;
            }
            $i++;
        }

        $user = Auth::user();
        return view('precios_empresas.index', [
            'th' => $th,
            'data' => $tabulador,
            'titulo' => 'Listado de precios por empresas',
            'role' => $user->role,
            'descripcion' => 'Tabulador de precios por cada empresa',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PrecioEmpresa  $precioEmpresa
     * @return \Illuminate\Http\Response
     */
    public function show(PrecioEmpresa $precioEmpresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PrecioEmpresa  $precioEmpresa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = PrecioEmpresa::where('id', $id)->first();

        $data->load('empresa', 'servicio','producto.categoria');

        return view('precios_empresas.edit', [
            'titulo' => $data->empresa->nombre,
            'data' => $data,
            'descripcion' => 'Actualizar precio',
        ]);
    }

    public function editBasePrice($id)
    {
        $producto = Producto::where('id', $id)->first();
        $servicios = Servicio::all();
        $categorias = Categoria::all();

        return view('productos.edit', [
            'data' => $producto,
            'servicios' => $servicios,
            'categorias' => $categorias,
            'origen'=> 'PrecioEmpresa',
            'titulo' => 'Editar Producto',
            'descripcion' => '',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PrecioEmpresa  $precioEmpresa
     * @return \Illuminate\Http\Response
     */
    //public function update(PrecioEmpresa $precioEmpresa)
    public function update(UpdatePrecioEmpresaRequest $request, $id)
    {
        $data = $request->validated();
        $data = PrecioEmpresa::find($id);
        $data->precio = $request->input('precio');
        $data->update();
        return redirect()->route('precios.index')
            ->with('success', 'El precio de la empresa ha sido editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PrecioEmpresa  $precioEmpresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrecioEmpresa $precioEmpresa)
    {
        //
    }

}
