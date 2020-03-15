<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Cotizacion, Material, ArchivoCotizacion, Gasto, Trabajo, Seguimiento};
use Storage, Auth, Session, View;


class OperacionesController extends Controller
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
        $cotizaciones = Cotizacion::where('status', 'OPERACIONES')->get();
        return view('operaciones.index', [
            'cotizaciones' => $cotizaciones,
            'titulo' => 'Operaciones',
            'descripcion' => 'Todas las operaciones con detalle',
        ]);
    }

    public function resumedBudget(Request $request)
    {
        if($request->ajax()) {
            $cotizacion = Cotizacion::where('id', $request->cotizacion_id)->first();
            return view('operaciones.cotizacionBase', [
                'item' => $cotizacion
            ]);
        }
    }

    public function getinfoCentros(Request $request)
    {
        if($request->ajax()) {
            $cotizacion = Cotizacion::where('id', $request->cotizacion_id)->first();
            return view('operaciones.datosCentro', [
                'item' => $cotizacion
            ]);
        }
    }

    public function newFile(Request $request)
    {
        $status = Cotizacion::find($request->cotizacion_id)->status;

        $file = $request->file('archivo');
        $filename = $file->getClientOriginalName();
        $path = '/cotizaciones/'.$request->cotizacion_id.'/'.$request->tipo.'/';

        if(!Storage::disk('public')->exists($path.$filename)) {
            Storage::disk('public')->put(
                $path.$filename,
                file_get_contents($file->getRealPath())
            );
            $archivoCot = new ArchivoCotizacion();
            $archivoCot->cotizacion_id = $request->cotizacion_id;
            $archivoCot->nombre = $file->getClientOriginalName();
            $archivoCot->tipo = $request->tipo;
            $archivoCot->responsable = Auth::user()->name;
            $archivoCot->save();
            $alert = ['success' => 'Archivo subido exitosamente'];
        } else {
            $alert = ['warning' => 'Archivo existente, intente con otro nombre'];
        }
        $gastos = ArchivoCotizacion::where('cotizacion_id', $request->cotizacion_id)
            ->where('tipo', 'GASTOS')
            ->get();
        $informes = ArchivoCotizacion::where('cotizacion_id', $request->cotizacion_id)
            ->where('tipo', 'INFORMES')
            ->get();
        $documentos = ArchivoCotizacion::where('cotizacion_id', $request->cotizacion_id)
            ->where('tipo', 'DOCUMENTOS')
            ->get();
        return view('operaciones.archivos', [
            'status' => $status,
            'gastos' => $gastos,
            'informes' => $informes,
            'documentos' => $documentos
        ])->nest('alerts', 'alerts', $alert);
    }

    public function getBudgetFiles(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;

            $gastos = ArchivoCotizacion::where('cotizacion_id', $request->cotizacion_id)
                ->where('tipo', 'GASTOS')
                ->get();
            $informes = ArchivoCotizacion::where('cotizacion_id', $request->cotizacion_id)
                ->where('tipo', 'INFORMES')
                ->get();
            $documentos = ArchivoCotizacion::where('cotizacion_id', $request->cotizacion_id)
                ->where('tipo', 'DOCUMENTOS')
                ->get();
            return view('operaciones.archivos', [
                'status' => $status,
                'gastos' => $gastos,
                'informes' => $informes,
                'documentos' => $documentos
            ]);
        }
    }

    public function deleteFile(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;
            $archivoCot = ArchivoCotizacion::where('id', $request->id)->first();
            $path = '/cotizaciones/'.$archivoCot->cotizacion_id.'/'.$archivoCot->tipo.'/'.$archivoCot->nombre;
            Storage::disk('public')->delete($path);
            $archivoCot->delete();
            $alert = ['success' => 'Archivo eliminado exitosamente'];

            $gastos = ArchivoCotizacion::where('cotizacion_id', $request->cotizacion_id)
                ->where('tipo', 'GASTOS')
                ->get();
            $informes = ArchivoCotizacion::where('cotizacion_id', $request->cotizacion_id)
                ->where('tipo', 'INFORMES')
                ->get();
            $documentos = ArchivoCotizacion::where('cotizacion_id', $request->cotizacion_id)
                ->where('tipo', 'DOCUMENTOS')
                ->get();
            return view('operaciones.archivos', [
                'status' => $status,
                'gastos' => $gastos,
                'informes' => $informes,
                'documentos' => $documentos
            ])->nest('alerts', 'alerts', $alert);
        }
    }

    public function getFile($id)
    {
        $archivoCot = ArchivoCotizacion::where('id', $id)->first();
        $path = '/cotizaciones/'.$archivoCot->cotizacion_id.'/'.$archivoCot->tipo.'/'.$archivoCot->nombre;
        return Storage::disk('public')->download($path);
    }

    public function getTotalCost(Request $request)
    {
        if($request->ajax()) {
            $trabajos = Trabajo::where('cotizacion_id', $request->cotizacion_id)->get();
            $gasto_total = 0;
            foreach($trabajos as $trabajo) {
                $gastos = Gasto::where('trabajo_id', $trabajo->id)->get();
                $gasto_total += $gastos->sum('gasto');
            }
            return response()->json([
                'gasto_total' => $gasto_total
            ]);
        }
    }

    public function facturar(Request $request)
    {
        $user = Auth::user();
        $aprobador = $user->name;
        $cotizacion = Cotizacion::where('id', $request->cotizacion_id)->first();
        $cotizacion->status = 'FACTURACIÓN';
        $cotizacion->save();
        $seguimiento = new Seguimiento();
        $seguimiento->cotizacion_id = $request->cotizacion_id;
        $seguimiento->status = 'FACTURACIÓN';
        $seguimiento->usuario = $aprobador;
        $seguimiento->save();

        Session::flash('success', 'La cotización '.$request->cotizacion_id.' ha sido enviada a facturación');
        $cotizaciones = Cotizacion::where('status', 'OPERACIONES')->get();
        return view('operaciones.index', [
            'cotizaciones' => $cotizaciones,
            'titulo' => 'Operaciones',
            'descripcion' => 'Todas las operaciones con detalle',
        ]);
    }
}
