<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Cotizacion, DetCotizacion, Seguimiento, Trabajo, Gasto};
use Barryvdh\DomPDF\Facade as PDF;
use Mail;
use Auth;
use Storage;

class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function generate($id)
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

        $pdf = PDF::loadView('pdf.report', [
            'data' => $cotizacion,
            'productos' => $productos,
        ]);
        
        $filename = 'cotizacion-'.$id.'.pdf';
        return $pdf->download($filename);
    }
    
    public function send($id)
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

        $pdf = PDF::loadView('pdf.report', [
            'data' => $cotizacion,
            'productos' => $productos,
        ]);
        
        $user = Auth::user();
        $aprobador = $user->name;
        
        $cotizacion = Cotizacion::where('id', $id)->first();
        $cotizacion->status = 'EVALUACIÓN_CLIENTE';
        $cotizacion->save();
        $seguimiento = new Seguimiento();
        $seguimiento->cotizacion_id = $id;
        $seguimiento->status = 'EVALUACIÓN_CLIENTE';
        $seguimiento->usuario = $aprobador;
        $seguimiento->save();

        $contacto_email = $cotizacion->contacto->email;
        $data = array(
            'name' => "Curso Laravel",
            'cotizacion' => $cotizacion,
        );

        $copia_oculta = $user->email;
        $asunto = 'Cotización N° '.$cotizacion->id;

        //$archivos = Storage::disk('local');
        
        //use ($contacto_email,$pdf,$copia_oculta)
        Mail::send('emails.welcome', $data, function ($message) use ($contacto_email, $pdf, $asunto) {
            $message->from('cualquiercosalguienalgo@gmail.com', 'Digitador');
            $message->to($contacto_email)->subject($asunto);
         // $message->bcc($copia_oculta, 'Digitador - PONER EL CORREO DEL USUARIO');
         // $message->bcc('cualquiercosalguienalgo@gmail.com', 'Digitador - PONER EL CORREO DEL USUARIO'); //COPIA OCULTA - FUNCIONA
            $message->attachData($pdf->output(), "Cotizacion.pdf");
         //   $message->attachData($archivos," ");
        });
        
        return redirect()->to('/')
                ->with('success', 'Tu email ha sido enviado correctamente');
    }

    public function uploadSpecialData(Request $request)
    {
        if($request->ajax()){        
            $file = $request->file('archivo');
            Storage::disk('local')->put(
                $request->carpeta."/".$file->getClientOriginalName(),
                file_get_contents($file->getRealPath())
            );
            
            $files = Storage::disk('local')->files($request->carpeta);
            $filenames = array();
            foreach ($files as $item) {
                $data = Storage::disk('local')->get($item);   
                $split = explode("/", $item);
                $name = $split[1];             
                array_push($filenames, $name);
            }
            return view('admin.specialFiles', [
                'filenames' => $filenames
            ]);
        }
    }

    public function deleteSpecialData(Request $request)
    {
        if($request->ajax()){
            $folder = $request->folder;
            $filename = $request->name;
            Storage::disk('local')->delete($folder.'/'.$filename);
            
            $files = Storage::disk('local')->files($request->folder);
            $filenames = array();
            foreach ($files as $item) {
                $data = Storage::disk('local')->get($item);   
                $split = explode("/", $item);
                $name = $split[1];
                array_push($filenames, $name);
            }
            return view('admin.specialFiles', [
                'filenames' => $filenames
            ]);
        }
    }
    
    public function sendSpecialData(Request $request)
    {
        if($request->ajax()){
            $cotizacion = Cotizacion::find($request->cotizacion_id);
            $productos = DetCotizacion::where('cotizacion_id', $cotizacion->id)->get();

            $user = Auth::user();
            $aprobador = $user->name;
            
            $cotizacion->status = 'OPERACIONES';
            $cotizacion->save();
            $seguimiento = new Seguimiento();
            $seguimiento->cotizacion_id = $request->cotizacion_id;
            $seguimiento->status = 'OPERACIONES';
            $seguimiento->usuario = $aprobador;
            $seguimiento->save();

            $data = array(
                'name' => "Curso Laravel",
                'cotizacion' => $cotizacion,
            );

            $contacto_email = $cotizacion->contacto->email;            
            $pdf = PDF::loadView('pdf.report', [
                'data' => $cotizacion,
                'productos' => $productos,
            ]);
            $carpeta = $request->carpeta_envio;
            $asunto = 'Cotización N° '.$cotizacion->id;

            Mail::send('emails.welcome', $data, function ($message) use ($contacto_email, $pdf, $carpeta, $asunto) {    
                $message->from('cualquiercosalguienalgo@gmail.com', 'Digitador');
                $message->to($contacto_email)->subject($asunto);
                $message->attachData($pdf->output(), "Cotizacion.pdf");
                $files = Storage::disk('local')->files($carpeta);
                foreach ($files as $item) {
                    $data = Storage::disk('local')->get($item);
                    $split = explode("/", $item);
                    $filename = $split[1];
                    $message->attachData($data, $filename);
                }
            });

            $folders = Storage::disk('local')->directories();
            foreach ($folders as $item) {
                if (strcmp($item, 'public') != 0) {
                    Storage::disk('local')->deleteDirectory($item);
                }
            }
            return 1;
        }
    }
    
    public function workReport($id)
    {
        $trabajos = Trabajo::where('cotizacion_id', $id)->get();
        
        $pdf = PDF::loadView('pdf.workReport', [
            'data' => $trabajos,
            'id' => $id
        ]);

        $filename = 'reporte-trabajo-cotizacion-'.$id.'.pdf';
        return $pdf->download($filename);        
    }
    
    public function costReport($id)
    {
        $trabajos = Trabajo::where('cotizacion_id', $id)->get();
        $data = array();
        foreach($trabajos as $item) {
            $gastos = Gasto::where('trabajo_id', $item->id)->get();
            array_push($data, $gastos);
        }
        
        $pdf = PDF::loadView('pdf.costReport', [
            'data' => $data,
            'trabajos' => $trabajos,
            'id' => $id,
        ]);

        $filename = 'reporte-gastos-cotizacion-'.$id.'.pdf';
        return $pdf->download($filename);        
    }
}