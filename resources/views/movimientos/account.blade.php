@extends('admin.layout')

@section('content')
    <div class="box">
        <div class="box-body">
            <table id="tablas" class="table table-bordered table-striped">
            <a href='{{ url("/transferencias/create/{$empresa_id}") }}' class="btn btn-primary btn-sm">
                                Registrar Transferencia
                            </a>
                <thead>
                    <tr>
                        <th scope="col"># Número</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Monto</th>
                        <th scope="col">Saldo</th>
                        <th scope="col">Motivo transferencia</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item['numero'] }}</td>
                            <td>{{ $item['fecha'] }}</td>
                            <td>{{ $item['monto'] }}</td>
                            <td>{{ $item['saldo'] }}</td>
                            <td>
                                @if($item['factura_id'] != NULL)
                                    <a class="btn btn-primary" href="{{ url("facturas/{$item['numero_factura_sii']}") }}">
                                    <i class="icon-shopping-cart icon-large"></i>Factura número {{ $item['id'] }}</a>
                                @else
                                    <a class="btn btn-primary" href="{{ url("transferencias/{$item['transferencia_id']}") }}">
                                    <i class="icon-shopping-cart icon-large"></i>Transferencia {{ $item['transferencia_id'] }}</a>
                                @endif
        			              </td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th scope="col"># Número</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Monto</th>
                        <th scope="col">Saldo</th>
                        <th scope="col">Motivo transferencia</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@stop
