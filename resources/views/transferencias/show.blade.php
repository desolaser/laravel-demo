@extends('admin.layout')

@section('content')
    <div class="box">
        <div class="box-body">
            <table class="table table-hover">
                <tbody>
                    <tr>
			                  <th scope="row">Tipo de pago</th>
			                  <th>{{ $transferencia->tipo_pago }}</th>
			              </tr>
                    <tr>
			                  <th scope="row">Monto</th>
			                  <th>{{ $transferencia->monto }}</th>
			              </tr>
                    <tr>
			                  <th scope="row">Fecha</th>
			                  <th>{{ $transferencia->fecha }}</th>
			              </tr>
                    <tr>
			                  <th scope="row">Banco</th>
			                  <th>{{ $transferencia->banco }}</th>
			              </tr>
                    <tr>
			                  <th scope="row">Número de cheque</th>
			                  <th>{{ $transferencia->numero_cheque }}</th>
			              </tr>
                    <tr>
			                  <th scope="row">Código de transferencia</th>
			                  <th>{{ $transferencia->codigo_transferencia }}</th>
			              </tr>
                </tbody>
            </table>

            <div class="panel panel-danger col-xs-6" style="padding-top: 20px">
            		<div class="panel-heading">Zona de adjuntos</div>
            		<div class="panel-body">
                    @if($files != "[]")
                    <ul class="list-group">
                        @foreach($files as $item)
                            <a style="margin: 10px" href='{{ url("transferencias/getFile/{$item->id}") }}'>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $item->nombre }}
                                    <span class="oi oi-eye left" style="float: right"></span>
                                </li>
                            </a>
                        @endforeach
                    </ul>
                    @else
                        No hay archivos en esta transferencia
                    @endif
            		</div>
          	</div>

            <div class="panel panel-primary col-xs-6" style="padding-top: 20px">
                <div class="panel-heading">Zona de facturas</div>
                <div class="panel-body">
                    @if($facturas != "[]")
                    <ul class="list-group">
                        @foreach($facturas as $item)
                            <a style="margin: 10px" href="{{ url("facturas/{$item->id}") }}">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $item->id }}
                                </li>
                            </a>
                        @endforeach
                    </ul>
                    @else
                        No hay facturas en esta transferencia
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
