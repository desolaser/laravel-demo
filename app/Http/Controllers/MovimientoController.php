<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Empresa, Movimiento, Factura};

class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Empresa::all();

        return view('movimientos.index', [
            'data' => $data,
            'titulo' => 'Cuentas corrientes',
            'descripcion' => 'Seleccione la empresa cuya cuente corriente será revisada',
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movimiento = Movimiento::find($id);

        return view('movimientos.show', [
            'movimiento' => $movimiento,
            'titulo' => 'Detalle movimiento',
            'descripcion' => 'Datos del movimiento seleccionado',
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
     * Display all company movements.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function account($id)
    {
        $empresa = Empresa::find($id);
        $movimientos = Movimiento::where('empresa_id', $id)
            ->orderBy('fecha')
            ->get();

        $data = array();
        $i = 0;
        foreach ($movimientos as $item) {
            if ($item->factura_id != null) {
                $factura = Factura::find($item->factura_id);
                $data[$i]['numero_factura_sii'] = $factura->numero_factura_sii;
            } else {
                $data[$i]['numero_factura_sii'] = null;
            }
            $data[$i]['numero'] = ($i + 1);
            $data[$i]['id'] = $item->id;
            $data[$i]['fecha'] = $item->fecha;
            $data[$i]['monto'] = $item->monto;
            $data[$i]['saldo'] = $item->saldo;
            $data[$i]['factura_id'] = $item->factura_id;
            $data[$i]['transferencia_id'] = $item->transferencia_id;
            $i++;
        }

        $titulo = 'Cuenta corriente de '.$empresa->nombre;

        return view('movimientos.account', [
            'data' => $data,
            'titulo' => $titulo,
            'empresa_id' => $id,
            'descripcion' => 'Listado de movimientos realizados',
        ]);
    }
}
