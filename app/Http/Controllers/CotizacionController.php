<?php

namespace App\Http\Controllers;

use App\{Cotizacion, DetCotizacion, Empresa, Centro, Contacto, Servicio, PrecioEmpresa, Temp, Nota, Seguimiento};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use DB;
use Auth;

class CotizacionController extends Controller
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
        $data = Cotizacion::all();
        return view('cotizaciones.index',  [
            'titulo' => 'Listado de Cotizaciones',
            'descripcion' => 'Todas las cotizaciones con detalle',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Empresa::query()
            ->orderBy('nombre')
            ->get();

        $servicios = Servicio::all();
        $notas = Nota::all();
        $cotizaciones = Cotizacion::all();

        $datos_tabla = DB::select("SHOW TABLE STATUS LIKE 'cotizaciones'");
        $siguiente_cotizacion = $datos_tabla[0]->Auto_increment;
        $titulo = 'Cotización #'.$siguiente_cotizacion;

        return view('cotizaciones.create', [
            'empresas' => $data,
            'servicios' => $servicios,
            'notas' => $notas,
            'cotizaciones' => $cotizaciones,
            'id_unique' => uniqid(),
            'titulo' => $titulo,
            'descripcion' => 'Generará una nueva cotización',
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
        $user = Auth::user();

        $this->validate($request, [
            'empresa_id' => 'required',
            'centro_id' => 'required',
            'contacto_id' => 'required',
            'viatico' => 'min:0',
            'descuento' => 'min:0',
        ]);
        if (strlen(trim($request->nota)) == 0) {
            $request->nota = 'SIN OBSERVACIONES';
        }

        $temp = Temp::where('id_unique', $request->id_unique)->get();

        DB::beginTransaction();
        try {
            $cotizacion = new Cotizacion;

            $cotizacion->empresa_id = $request->empresa_id;
            $cotizacion->centro_id = $request->centro_id;
            $cotizacion->contacto_id = $request->contacto_id;
            $cotizacion->nota = $request->nota;
            $cotizacion->viatico = $request->viatico;
            $cotizacion->sumatoria = $request->sumatoria;
            $cotizacion->descuento = $request->descuento;
            $cotizacion->subtotal = $request->subtotal;
            $cotizacion->impuesto = $request->impuesto;
            $cotizacion->total =  $request->total;
            $cotizacion->status = 'EN_DISEÑO';
            $cotizacion->responsable = $user->name;
            $cotizacion->save();

            foreach ($temp as $item) {
                $detalle = new DetCotizacion();
                $detalle->cotizacion_id = $cotizacion->id;
                $detalle->servicio_id = $item->servicio_id;
                $detalle->producto_id = $item->producto_id;
                $detalle->cantidad = $item->cantidad;
                $detalle->precio = $item->precio;
                $detalle->total = $item->total;
                $detalle->save();
            }

            $temp = Temp::where('id_unique', $request->id_unique)->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        $data = Empresa::query()
            ->orderBy('nombre')
            ->get();
        $servicios = Servicio::all();
        $notas = Nota::all();
        $cotizaciones = Cotizacion::all();
        $ultima_cotizacion = DB::table('cotizaciones')->latest('id')->first();

        if ($ultima_cotizacion == null) {
            $titulo = 'Cotización #1';
        }
        else{
            $titulo = 'Cotización #' . ($ultima_cotizacion->id + 1);
        }

        return redirect()->route('cotizaciones.create', [
            'empresas' => $data,
            'servicios' => $servicios,
            'notas' => $notas,
            'cotizaciones' => $cotizaciones,
            'id_unique' => uniqid(),
            'titulo' => $titulo,
            'descripcion' => 'Generara una nueva cotización',
        ])->with('success', 'La cotización ha sido registrada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cotizacion = Cotizacion::where('id', $id)->first();
        $productos = DetCotizacion::where('cotizacion_id', $cotizacion->id)->get();

        foreach ($productos as $item) {
            $item->precio = number_format($item->precio, '0', ',', '.');
            $item->total = number_format($item->total, '0', ',', '.');
        }

        $cotizacion->viatico = number_format($cotizacion->viatico, '0', ',', '.');
        $cotizacion->sumatoria = number_format($cotizacion->sumatoria, '0', ',', '.');
        $cotizacion->descuento = number_format($cotizacion->descuento, '0', ',', '.');
        $cotizacion->subtotal = number_format($cotizacion->subtotal, '0', ',', '.');
        $cotizacion->impuesto = number_format($cotizacion->impuesto, '0', ',', '.');
        $cotizacion->total = number_format($cotizacion->total, '0', ',', '.');

        return view('cotizaciones.show', [
            'data' => $cotizacion,
            'productos' => $productos,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Empresa::query()
            ->orderBy('nombre')
            ->get();
        $servicios = Servicio::all();
        $notas = Nota::all();
        $cotizacion = Cotizacion::find($id);
        $titulo = 'Cotización #' . ($id);

        return view('cotizaciones.edit', [
            'empresas' => $data,
            'servicios' => $servicios,
            'notas' => $notas,
            'cotizacion' => $cotizacion,
            'id_unique' => uniqid(),
            'titulo' => $titulo,
            'descripcion' => 'Generará una nueva cotización',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'empresa_id' => 'required',
            'centro_id' => 'required',
            'contacto_id' => 'required',
            'nota' => 'min:0',
            'viatico' => 'min:0',
            'sumatoria' => 'min:0',
            'descuento' => 'min:0',
            'subtotal' => 'min:0',
            'impuesto' => 'min:0',
            'total' => 'min:0',
        ]);
        if (strlen(trim($data['nota'])) == 0) {
            $data['nota'] = 'SIN OBSERVACIONES';
        }

        DB::beginTransaction();
        try {
            $cotizacion = Cotizacion::where('id', $id)->first();
            $cotizacion->empresa_id = $data['empresa_id'];
            $cotizacion->centro_id = $data['centro_id'];
            $cotizacion->contacto_id = $data['contacto_id'];
            $cotizacion->nota = $data['nota'];
            $cotizacion->viatico = $data['viatico'];
            $cotizacion->sumatoria = $data['sumatoria'];
            $cotizacion->descuento = $data['descuento'];
            $cotizacion->subtotal = $data['subtotal'];
            $cotizacion->impuesto = $data['impuesto'];
            $cotizacion->total = $data['total'];
            $cotizacion->save();
            $temp = Temp::where('id_unique', $request->id_unique)->get();
            foreach ($temp as $item) {
                $det_cotizacion = DetCotizacion::where('id', $item->det_cotizacion_id)->first();
                if (!$det_cotizacion) {
                    $detalle = new DetCotizacion();
                    $detalle->cotizacion_id = $cotizacion->id;
                    $detalle->servicio_id = $item->servicio_id;
                    $detalle->producto_id = $item->producto_id;
                    $detalle->cantidad = $item->cantidad;
                    $detalle->precio = $item->precio;
                    $detalle->total = $item->total;
                    $detalle->save();
                }
                else if ($det_cotizacion->cantidad != $item->cantidad) {
                    $det_cotizacion->cantidad = $item->cantidad;
                    $det_cotizacion->total = $det_cotizacion->cantidad * $det_cotizacion->precio;
                    $det_cotizacion->save();
                }
            }
            $temp = Temp::where('id_unique', $request->id_unique)->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect()->route('cotizaciones.index')
            ->with('success', 'La cotización ha sido editada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cotizacion = Cotizacion::where('id', $id)->first();
        DB::beginTransaction();
        try {
            $productos = DetCotizacion::where('cotizacion_id', $id)->get();
            foreach ($productos as $item) {
                $item->delete();
            }
            $cotizacion->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return redirect()->route('cotizaciones.index')
            ->with('success', 'La cotización ha sido eliminada exitosamente');
    }

    public function getDetalleCotizacion(Request $request) {
        if($request->ajax()) {
            $cotizacion = Cotizacion::where('id', $request->cotizacion_id)->first();
            return Response::json($cotizacion);
        }
    }

    public function getCentros(Request $request) {
        if($request->ajax()) {
            $centros = Centro::where('empresa_id', $request->empresa_id)->get();
            return Response::json($centros);
        }
    }

    public function getContactos(Request $request) {
        if($request->ajax()) {
            $contactos = Contacto::where('centro_id', $request->centro_id)->get();
            return Response::json($contactos);
        }
    }

    public function getProductos(Request $request) {
        if($request->ajax()) {
            $productos = PrecioEmpresa::where('empresa_id', $request->empresa_id)
                ->Where('servicio_id', $request->servicio_id)
                ->get();
            return view('cotizaciones.getProductos',[
                'data' => $productos
            ]);
        }
    }

    public function setProductos(Request $request) {
        if($request->ajax()) {
            if($request->pagina == 'getProductos')
            {
                $exists = false;
                $producto = PrecioEmpresa::find($request->id);
                $staged = Temp::where('id_unique', $request->id_unique)->get();
                foreach ($staged as $item) {
                    if($producto->producto_id == $item->producto_id) {
                        $item->cantidad += $request->cantidad;
                        $item->total = $item->cantidad * $producto->precio;
                        $exists = true;
                        $item->save();
                        break;
                    }
                }
                if ($exists == false) {
                    $data = new Temp();
                    $data->id_unique = $request->id_unique;
                    $data->servicio_id =  $producto->servicio_id;
                    $data->producto_id =  $producto->producto_id;
                    $data->precio =  $producto->precio;
                    $data->cantidad =  $request->cantidad;
                    $data->total =  $request->cantidad * $producto->precio;
                    $data->save();
                }
            }
            if($request->pagina == 'setCantidad')
            {
                $temp = Temp::where('id', $request->id)->first();
                $temp->cantidad = $request->cantidad;
                $temp->total = $temp->cantidad * $temp->precio;
                $temp->save();
            }
            else if($request->pagina == 'getProductosAnteriores'){
                $productos_anteriores = Temp::where('id_unique', $request->id_unique)->get();
                foreach ($productos_anteriores as $producto) {
                    $producto->delete();
                }
                $productos = DetCotizacion::where('cotizacion_id', $request->cotizacion_id)->get();
                foreach ($productos as $producto) {
                    $data = new Temp();
                    $data->id_unique = $request->id_unique;
                    $data->servicio_id =  $producto->servicio_id;
                    $data->producto_id =  $producto->producto_id;
                    $data->precio =  $producto->precio;
                    $data->cantidad =  $producto->cantidad;
                    $data->total =  $producto->total;
                    $data->save();
                }
            }
            else if($request->pagina == 'getProductosEdicionAnteriores'){
                $productos = DetCotizacion::where('cotizacion_id', $request->cotizacion_id)->get();
                foreach ($productos as $producto) {
                    $data = new Temp();
                    $data->id_unique = $request->id_unique;
                    $data->det_cotizacion_id =  $producto->id;
                    $data->servicio_id =  $producto->servicio_id;
                    $data->producto_id =  $producto->producto_id;
                    $data->precio =  $producto->precio;
                    $data->cantidad =  $producto->cantidad;
                    $data->total =  $producto->total;
                    $data->save();
                }
            }

            $data = Temp::where('id_unique', $request->id_unique)
                ->orderBy('servicio_id')
                ->get();

            $registros = $data->count() + 1;

            $sumatoria = $data->sum('total') + $request->viatico;
            $subtotal = $sumatoria - $request->descuento;
            $impuesto = $subtotal * .19;
            $total = $subtotal + $impuesto;

            return view('cotizaciones.setProductos',[
                'data' => $data,
                'viatico' => $request->viatico,
                'descuento' => $request->descuento,
                'sumatoria' => $sumatoria,
                'subtotal' => $subtotal,
                'impuesto' => $impuesto,
                'total' => $total,
                'registros' => $registros,
            ]);
        }
    }

    public function delRow(Request $request)
    {
        $temp = Temp::find($request->id);
        $id_unique = $temp->id_unique;
        $temp->delete();
        $data = Temp::where('id_unique', $id_unique)
                ->orderBy('servicio_id')
                ->get();

        $det_cotizacion = DetCotizacion::where('id', $request->det_cotizacion_id)->first();
        if ($det_cotizacion != null) {
            $det_cotizacion->delete();
        }

        $sumatoria = $data->sum('total');
        $subtotal = $sumatoria;
        $impuesto = $subtotal * .19;
        $total = $subtotal + $impuesto;

        return view('cotizaciones.setProductos',[
            'data' => $data,
            'viatico' => $request->viatico,
            'descuento' => $request->descuento,
            'sumatoria' => $sumatoria,
            'subtotal' => $subtotal,
            'impuesto' => $impuesto,
            'total' => $total,
            'registros' => $data->count(),
        ]);
    }

    public function reactivate(Request $request, $id)
    {
        $cotizacion = Cotizacion::where('id', $id)->first();
        if ($cotizacion->status != 'RECHAZADO-EXTERNO' && $cotizacion->status != 'ANULADO-INTERNO') {
            return redirect()->route('cotizaciones.index')
                ->with('warning', 'La cotización ya está activa');
        }
        $cotizacion->status = 'EN_DISEÑO';
        $cotizacion->save();
        $seguimiento = new Seguimiento();
        $seguimiento->cotizacion_id = $id;
        $seguimiento->status = 'EN_DISEÑO';
        $seguimiento->usuario = $cotizacion->responsable;
        $seguimiento->save();
    }
}
