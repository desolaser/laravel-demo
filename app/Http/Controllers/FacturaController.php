<?php

namespace App\Http\Controllers;

use App\{Cotizacion, Empresa, Factura, TempArchivo, TempCotizacion,
  ArchivoFactura, Movimiento};
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use DB;
use Storage;

class FacturaController extends Controller
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
        $cotizaciones = Cotizacion::where('status', 'FACTURACIÓN')->get();
        return view('facturas.index', [
            'data' => $cotizaciones,
            'titulo' => 'Facturación',
            'descripcion' => 'Todas las cotizaciones que ya están en estado de facturación',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cotizaciones = Cotizacion::where('status', 'FACTURACIÓN')->get();
        $empresas = Empresa::all();

        return view('facturas.create', [
            'id_unique' => uniqid(),
            'cotizaciones' => $cotizaciones,
            'empresas' => $empresas,
            'titulo' => 'Crear factura',
            'descripcion' => 'Formulario de captura de datos de la factura',
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
        $empresa = Empresa::find($request->empresa_id);

        $request['rut'] = $empresa->rut;
        $request['razon_social'] = $empresa->razon_social;

        $data = $this->validate($request, [
            'rut' => 'required|string',
            'razon_social' => 'required|string',
            'monto' => 'required|integer',
            'fecha' => 'required|date',
            'resumen' => 'required|string',
            'numero_factura_sii' => 'required|integer',
        ]);

        $temps_cotizaciones = TempCotizacion::where('id_unique', $request->id_unique)->get();
        if($temps_cotizaciones->isEmpty()) {
            return redirect()->route('facturas.create')
              ->with('warning', 'Ingrese alguna cotización a la factura antes de crearla');
        }

        $temps_archivos = TempArchivo::where('id_unique', $request->id_unique)->get();

        DB::beginTransaction();
        try {
            $empresa->saldo += $data['monto'];
            $empresa->save();

            $factura = Factura::create([
                'rut' => $data['rut'],
                'razon_social' => $data['razon_social'],
                'monto' => $data['monto'],
                'fecha' => $data['fecha'],
                'resumen' => $data['resumen'],
                'numero_factura_sii' => $data['numero_factura_sii']
            ]);
            $factura->save();

            foreach($temps_archivos as $archivo) {
                $archivo_factura = ArchivoFactura::create([
                    'nombre' => $archivo->nombre,
                    'factura_id' => $factura->id,
                ]);
                $archivo_factura->save();
                $old_path = '/archivos_temporales_factura/'.$request->id_unique.'/'.$archivo->nombre;
                $new_path = '/archivos_factura/'.$factura->id.'/'.$archivo->nombre;
                Storage::disk('public')->move($old_path, $new_path);
            }

            $temps_archivos = TempArchivo::all();
            foreach($temps_archivos as $archivo) {
                $path = '/archivos_temporales_factura/'.$archivo->id_unique.'/'.$archivo->nombre;
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
                $archivo->delete();
            }

            foreach($temps_cotizaciones as $temp_cotizacion) {
                $cotizacion = Cotizacion::find($temp_cotizacion->cotizacion_id);
                $cotizacion->factura_id = $factura->id;
                $cotizacion->status = 'FACTURA_EMITIDA';
                $cotizacion->save();
            }

            $temps_cotizaciones = TempCotizacion::all();
            foreach($temps_cotizaciones as $temp_cotizacion) {
                $temp_cotizacion->delete();
            }

            $fecha_actual = date('Y-m-d H:i:s');

            $movimiento = Movimiento::create([
                'fecha' => $fecha_actual,
                'monto' => $factura->monto,
                'saldo' => $empresa->saldo,
                'empresa_id' => $empresa->id,
                'factura_id' => $factura->id,
                'transferencia_id' => NULL
            ]);
            $movimiento->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect()->route('facturas.create')
            ->with('success', 'La factura ha sido registrada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $factura = Factura::find($id);
        $archivos = ArchivoFactura::where('factura_id', $id)->get();
        $cotizaciones = Cotizacion::where('factura_id', $id)->get();

        return view('facturas.show', [
            'factura' => $factura,
            'files' => $archivos,
            'cotizaciones' => $cotizaciones,
            'titulo' => 'Detalle factura',
            'descripcion' => 'Datos de la factura seleccionada',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('facturas.edit', [
            'data' => $factura,
            'titulo' => 'Editar Factura',
            'descripcion' => '',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factura $factura)
    {
        $data = $this->validate($request, [
            'rut' => 'required|string',
            'razon_social' => 'required|string',
            'monto' => 'required|integer',
            'fecha' => 'required|date',
            'resumen' => 'required|string'
        ]);

        $factura->update($data);

        return redirect()->route('facturas.index')
            ->with('success', 'La factura ha sido editada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {
        //
        DB::beginTransaction();
        try {
            $facturas = Factura::find($factura->id);
            foreach ($facturas as $item) {
                $item->delete();
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        $empresa->delete();
        return redirect()->route('facturas.index')
            ->with('success', 'La factura ha sido eliminada exitosamente');
    }

    public function newFile(Request $request)
    {
        $file = $request->file('archivo');
        $filename = $file->getClientOriginalName();
        $path = '/archivos_temporales_factura/'.$request->id_unique.'/';

        if(!Storage::disk('public')->exists($path.$filename)) {
            Storage::disk('public')->put(
                $path.$filename,
                file_get_contents($file->getRealPath())
            );
            $temp_archivo = new TempArchivo();
            $temp_archivo->id_unique = $request->id_unique;
            $temp_archivo->nombre = $filename;
            $temp_archivo->save();
            $alert = ['success' => 'Archivo subido exitosamente'];
        } else {
            $alert = ['warning' => 'Archivo existente, intente con otro nombre'];
        }

        $temp_archivos = TempArchivo::where('id_unique', $request->id_unique)
            ->get();
        return view('facturas.files', [
            'files' => $temp_archivos
        ]);
    }

    public function deleteFile(Request $request)
    {
        if($request->ajax()) {
            $temp_archivo = TempArchivo::find($request->id);
            $path = '/archivos_temporales_factura/'.$request->id_unique.'/'.$temp_archivo->nombre;
            Storage::disk('public')->delete($path);
            $temp_archivo->delete();
            $alert = ['success' => 'Archivo eliminado exitosamente'];

            $temp_archivos = TempArchivo::where('id_unique', $request->id_unique)
                ->get();
            return view('facturas.files', [
                'files' => $temp_archivos
            ]);
        }
    }

    public function getTempFile($id)
    {
        $temp_archivo = TempArchivo::find($id);
        $path = '/archivos_temporales_factura/'.$temp_archivo->id_unique.'/'.$temp_archivo->nombre;

        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->download($path);
        }
        else {
            return redirect()->back()
                ->with('danger', 'Archivo no encontrado');
        }
    }

    public function getFile($id)
    {
        $archivo = ArchivoFactura::find($id);
        $path = '/archivos_factura/'.$archivo->factura_id.'/'.$archivo->nombre;

        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->download($path);
        }
        else {
            return redirect()->back()
                ->with('danger', 'Archivo no encontrado');
        }
    }

    public function newCotizacion(Request $request)
    {
        $temp_cotizacion = new TempCotizacion();
        $temp_cotizacion->id_unique = $request->id_unique;
        $temp_cotizacion->cotizacion_id = $request->cotizacion_id;
        $temp_cotizacion->save();
        $alert = ['success' => 'Cotización cargada'];

        $temp_cotizaciones = TempCotizacion::where('id_unique', $request->id_unique)
            ->get();
        return view('facturas.cotizaciones', [
            'cotizaciones' => $temp_cotizaciones
        ]);
    }

    public function deleteCotizacion(Request $request)
    {
        if($request->ajax()) {
            $temp_cotizacion = TempCotizacion::find($request->id);
            $temp_cotizacion->delete();
            $alert = ['success' => 'Cotizacion eliminada exitosamente'];

            $temp_cotizaciones = TempCotizacion::where('id_unique', $request->id_unique)
                ->get();
            return view('facturas.cotizaciones', [
                'cotizaciones' => $temp_cotizaciones
            ]);
        }
    }

    public function getCotizaciones(Request $request)
    {
        if($request->ajax()) {
            $cotizaciones = Cotizacion::where('empresa_id', $request->empresa_id)->
                where('status', 'FACTURACIÓN')->get();
            return Response::json($cotizaciones);
        }
    }
}
