@extends('admin.layout')

@section('content')
    <div class="box">
        <div class="box-body">
            <input type="hidden" name="factura_id" id="{{ $factura->id }}">
            <table class="table table-hover">
                <tbody>
                    <tr>
			                  <th scope="row">RUT</th>
			                  <th>{{ $factura->rut }}</th>
			              </tr>
                    <tr>
			                  <th scope="row">Razón social</th>
			                  <th>{{ $factura->razon_social }}</th>
			              </tr>
                    <tr>
			                  <th scope="row">Fecha</th>
			                  <th>{{ $factura->fecha }}</th>
			              </tr>
                    <tr>
			                  <th scope="row">Resumen</th>
			                  <th>{{ $factura->resumen }}</th>
			              </tr>
                    <tr>
			                  <th scope="row">Monto</th>
			                  <th>{{ $factura->monto }}</th>
			              </tr>
                    <tr>
			                  <th scope="row">Num. factura SII</th>
			                  <th>{{ $factura->numero_factura_sii }}</th>
			              </tr>
                </tbody>
            </table>

            <div class="panel panel-danger col-xs-6" style="padding-top: 20px">
            		<div class="panel-heading">Zona de adjuntos</div>
            		<div class="panel-body">
                    @if($files != "[]")
                    <ul class="list-group">
                        @foreach($files as $item)
                            <a style="margin: 10px" href='{{ url("facturas/getFile/{$item->id}") }}'>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $item->nombre }}
                                <span class="oi oi-eye left" style="float: right"></span>
                            </li>
                            </a>
                        @endforeach
                    </ul>
                    @else
                        No hay archivos en esta factura
                    @endif
            		</div>
          	</div>

            <div class="panel panel-primary col-xs-6" style="padding-top: 20px">
                <div class="panel-heading">Zona de cotización</div>
                <div class="panel-body">
                    @if($cotizaciones != "[]")
                    <ul class="list-group">
                        @foreach($cotizaciones as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $item->id }}
                            </li>
                        @endforeach
                    </ul>
                    @else
                        No hay cotizaciones en esta factura
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
