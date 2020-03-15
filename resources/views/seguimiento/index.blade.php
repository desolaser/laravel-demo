@extends('admin.layout')

@section('content')
@csrf
@method('DELETE')
@if ($role == 'SUPERUSUARIO' || $role == 'SUPERVISOR')
	<div class="box">
        <div class="box-body">
            <p id="date_filter">
                <span id="date-label-from" class="date-label">Desde: </span><input class="date_range_filter date" type="text" id="datepicker_from" />
                <span id="date-label-to" class="date-label">Hasta: </span><input class="date_range_filter date" type="text" id="datepicker_to" />
            </p>
            <table id="tablas" class="table table-bordered table-striped">
                <thead>
                    <tr>
					<!--	<th scope="col"># Seguimiento</th>  -->
			            <th scope="col"># Cotización</th>
						<th scope="col">AUTOR</th>
						<th scope="col">STATUS</th>
						<th scope="col">RESPONSABLE</th>
						<th scope="col">FECHA</th>
			        </tr>
                </thead>
                
                <tbody>
                   @foreach($data as $item)
			            <tr>
			            <!--    <th scope="row">{{ $item->id }}</th>  -->
							<td>{{ $item->cotizacion->id }}</td>
			                <td>{{ $item->cotizacion->responsable }}</td>
							<td>{{ $item->status }}</td>
			                <td>{{ $item->usuario }}</td>
			                <td>{{ $item->created_at->toDateTimeString() }}</td>
			            </tr>
			        @endforeach
                </tbody>
                
                <tfoot>
	                <tr>
			<!--			<th scope="col"># Seguimiento</th>  -->
			            <th scope="col"># Cotización</th>
						<th scope="col">AUTOR</th>
						<th scope="col">STATUS</th>
						<th scope="col">RESPONSABLE</th>
						<th scope="col">FECHA</th>
	                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endif
@stop
