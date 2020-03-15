<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Factura, Transferencia, ArchivoTransferencia, Empresa,
  Movimiento, TempArchivo, TempFactura, Cotizacion};
use Storage;
use DB;

class TransferenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($empresa_id)
    {
        $facturas = Factura::whereHas('cotizaciones', function ($query) use ($empresa_id) {
            $query->where('empresa_id', $empresa_id);
        })->get();

        return view('transferencias.create', [
            'id_unique' => uniqid(),
            'facturas' => $facturas,
            'empresa_id' => $empresa_id,
            'titulo' => 'Crear transferencia',
            'descripcion' => 'Formulario de captura de datos de la transferencia',
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

          switch ($request->tipo_pago) {
             case "EFECTIVO":
                $data = $this->validate($request, [
                     'tipo_pago' => 'required|string',
                     'monto' => 'required|integer',
                     'fecha' => 'required|date'
                ]);
                $data['banco'] = NULL;
                $data['codigo_transferencia'] = NULL;
                $data['numero_cheque'] = NULL;
                break;
             case "TRANSFERENCIA":
                 $data = $this->validate($request, [
                     'tipo_pago' => 'required|string',
                     'monto' => 'required|integer',
                     'fecha' => 'required|date',
                     'banco' => 'required|string',
                     'codigo_transferencia' => 'required|string'
                 ]);
                 $data['numero_cheque'] = NULL;
                 break;
             case "CHEQUE":
                 $data = $this->validate($request, [
                     'tipo_pago' => 'required|string',
                     'monto' => 'required|integer',
                     'fecha' => 'required|date',
                     'banco' => 'required|string',
                     'numero_cheque' => 'required|string',
                 ]);
                 $data['codigo_transferencia'] = NULL;
                break;
             case "OTROS":
                 $data = $this->validate($request, [
                     'tipo_pago' => 'required|string',
                     'monto' => 'required|integer',
                     'fecha' => 'required|date',
                 ]);
                 $data['banco'] = NULL;
                 $data['codigo_transferencia'] = NULL;
                 $data['numero_cheque'] = NULL;
                break;
         }

         $temps_archivos = TempArchivo::where('id_unique', $request->id_unique)->get();
         $temps_facturas = TempFactura::where('id_unique', $request->id_unique)->get();

         DB::beginTransaction();
         try {
             $empresa->saldo -= $data['monto'];
             $empresa->save();


             $transferencia = Transferencia::create([
                 'tipo_pago' => $data['tipo_pago'],
                 'monto' => $data['monto'],
                 'fecha' => $data['fecha'],
                 'banco' => $data['banco'],
                 'numero_cheque' => $data['numero_cheque'],
                 'codigo_transferencia' => $data['codigo_transferencia']
             ]);
             $transferencia->save();

             foreach($temps_archivos as $archivo) {
                 $archivo_transferencia = ArchivoTransferencia::create([
                     'nombre' => $archivo->nombre,
                     'transferencia_id' => $transferencia->id,
                 ]);
                 $archivo_transferencia->save();
                 $old_path = '/archivos_temporales_transferencia/'.$request->id_unique.'/'.$archivo->nombre;
                 $new_path = '/archivos_transferencia/'.$transferencia->id.'/'.$archivo->nombre;
                 Storage::disk('public')->move($old_path, $new_path);
             }

             $temps_archivos = TempArchivo::all();
             foreach($temps_archivos as $archivo) {
                 $path = '/archivos_temporales_transferencia/'.$request->id_unique.'/'.$archivo->nombre;
                 if(Storage::disk('public')->exists($path)) {
                     Storage::disk('public')->delete($path);
                 }
                 $archivo->delete();
             }

             foreach($temps_facturas as $temp_factura) {
                 $factura = Factura::find($temp_factura->factura_id);
                 $factura->transferencia_id = $transferencia->id;
                 $factura->save();
             }

             $temps_facturas = TempFactura::all();
             foreach($temps_facturas as $temp_factura) {
                 $temp_factura->delete();
             }

             $fecha_actual = date('Y-m-d H:i:s');
             $movimiento = Movimiento::create([
                 'fecha' => $fecha_actual,
                 'monto' => (-1 * $transferencia->monto),
                 'saldo' => $empresa->saldo,
                 'empresa_id' => $empresa->id,
                 'factura_id' => NULL,
                 'transferencia_id' => $transferencia->id
             ]);
             $movimiento->save();

             DB::commit();
         } catch (Exception $e) {
             DB::rollback();
         }
         return redirect('transferencias/create/'.$empresa->id)
             ->with('success', 'La transferencia ha sido registrada exitosamente');
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transferencia = Transferencia::find($id);
        $archivos = ArchivoTransferencia::where('transferencia_id', $id)->get();
        $facturas = Factura::where('transferencia_id', $id)->get();

        return view('transferencias.show', [
            'transferencia' => $transferencia,
            'files' => $archivos,
            'facturas' => $facturas,
            'titulo' => 'Detalle transferencia',
            'descripcion' => 'Datos de la transferencia seleccionada',
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Downloads a file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function newFile(Request $request)
     {
         $file = $request->file('archivo');
         $filename = $file->getClientOriginalName();
         $path = '/archivos_temporales_transferencia/'.$request->id_unique.'/';

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
         return view('transferencias.files', [
             'files' => $temp_archivos
         ]);
     }

     public function deleteFile(Request $request)
     {
         if($request->ajax()) {
             $temp_archivo = TempArchivo::find($request->id);
             $path = '/archivos_temporales_transferencia/'.$request->id_unique.'/'.$temp_archivo->nombre;
             Storage::disk('public')->delete($path);
             $temp_archivo->delete();
             $alert = ['success' => 'Archivo eliminado exitosamente'];

             $temp_archivos = TempArchivo::where('id_unique', $request->id_unique)
                 ->get();
             return view('transferencias.files', [
                 'files' => $temp_archivos
             ]);
         }
     }

     public function getTempFile($id)
     {
         $temp_archivo = TempArchivo::find($id);
         $path = '/archivos_temporales_transferencia/'.$temp_archivo->id_unique.'/'.$temp_archivo->nombre;

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
         $archivo = ArchivoTransferencia::find($id);
         $path = '/archivos_transferencia/'.$archivo->transferencia_id.'/'.$archivo->nombre;
         
         if (Storage::disk('public')->exists($path)) {
             return Storage::disk('public')->download($path);
         }
         else {
             return redirect()->back()
                 ->with('danger', 'Archivo no encontrado');
         }
     }

     public function newBill(Request $request)
     {
         $temp_factura = new TempFactura();
         $temp_factura->id_unique = $request->id_unique;
         $temp_factura->factura_id = $request->factura_id;
         $temp_factura->save();
         $alert = ['success' => 'Factura cargada'];

         $temp_facturas = TempFactura::where('id_unique', $request->id_unique)
             ->get();
         return view('transferencias.bills', [
             'facturas' => $temp_facturas
         ]);
     }


     public function deleteBill(Request $request)
     {
         if($request->ajax()) {
             $temp_factura = TempFactura::find($request->id);
             $temp_factura->delete();
             $alert = ['success' => 'Factura eliminada exitosamente'];

             $temp_facturas = TempFactura::where('id_unique', $request->id_unique)
                 ->get();
             return view('transferencias.bills', [
                 'facturas' => $temp_facturas
             ]);
         }
     }
}
