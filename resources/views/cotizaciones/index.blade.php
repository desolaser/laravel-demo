@extends('admin.layout')

@section('content')
	<div class="box">
		<a href="{{ url('cotizaciones/create')}}" class="btn btn-sm btn-primary">Agregar nuevo registro</a>
        <div class="box-body">
            <p id="date_filter">
                <span id="date-label-from" class="date-label">Desde: </span><input class="date_range_filter date" type="text" id="datepicker_from" />
                <span id="date-label-to" class="date-label">Hasta: </span><input class="date_range_filter date" type="text" id="datepicker_to" />
            </p>
            <table id="tablas" class="table table-bordered table-striped">
                <thead>
                    <tr>
			            <th scope="col">#</th>
			            <th scope="col">Empresa</th>
			            <th scope="col">Centro</th>
			            <th scope="col">Contacto</th>
			            <th scope="col">Fecha Ingreso</th>
			            <th scope="col">Nota</th>
			            <th scope="col">Viático</th>
			            <th scope="col">Sumatoria</th>
			            <th scope="col">Descuento</th>
			            <th scope="col">Subtotal</th>
			            <th scope="col">Impuesto</th>
			            <th scope="col">Total</th>
			            <th scope="col">Status</th>
			            <th scope="col">Autor</th>
			            <th scope="col">Acciones</th>
			        </tr>
                </thead>
                
                <tbody>
                   @foreach($data as $item)
			            <tr>
			                <th scope="row">{{ $item->id }}</th>
			                <td>{{ $item->empresa->nombre }}</td>
			                <td>{{ $item->centro->nombre }}</td>
			                <td>{{ $item->contacto->nombre }}</td>
			                <td>{{ $item->created_at->toDateString() }}</td>
			                <td>{{ $item->nota }}</td>
			                <td>{{ $item->viatico }}</td>
			                <td>{{ $item->sumatoria }}</td>
			                <td>{{ $item->descuento }}</td>
			                <td>{{ $item->subtotal }}</td>
			                <td>{{ $item->impuesto }}</td>
			                <td>{{ $item->total }}</td>
			                <td>{{ $item->status }}</td>
			                <td>{{ $item->responsable }}</td>
			                <td>
								<a href="{{ route('cotizaciones.edit', $item->id) }}">
									<span class="oi oi-eye"></span>
								</a>
								<a href="{{ url("cotizaciones/reactivate/{$item->id}") }}">
									<span class="oi oi-action-undo"></span>
								</a>
			                </td>
			            </tr>
			        @endforeach
                </tbody>
                
                <tfoot>
	                <tr>
			            <th scope="col">#</th>
			            <th scope="col">Empresa</th>
			            <th scope="col">Centro</th>
			            <th scope="col">Contacto</th>
			            <th scope="col">Fecha Ingreso</th>
			            <th scope="col">Nota</th>
			            <th scope="col">Viático</th>
			            <th scope="col">Sumatoria</th>
			            <th scope="col">Descuento</th>
			            <th scope="col">Subtotal</th>
			            <th scope="col">Impuesto</th>
			            <th scope="col">Total</th>
			            <th scope="col">Status</th>
			            <th scope="col">Autor</th>
			            <th scope="col">Acciones</th>
	                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@stop
