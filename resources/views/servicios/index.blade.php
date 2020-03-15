@extends('admin.layout')

@section('content')
	<div class="box">
		<a href="{{ url('servicios/create')}}" class="btn btn-sm btn-primary">Agregar nuevo registro</a>
        <div class="box-body">
            <table id="tablas" class="table table-bordered table-striped">
                <thead>
                    <tr>
			            <th scope="col">#</th>
			            <th scope="col">Nombre</th>
			            <th scope="col">Productos</th>
			            <th scope="col">Acciones</th>
			        </tr>
                </thead>
                
                <tbody>
                   @foreach($data as $items)
			            <tr>
			                <th scope="row">{{ $items->id }}</th>
			                <td>{{ $items->nombre }}</td>
			                <td>{{ $items->productos_count }}</td>							
							<td>								
								<a href='{{ url("servicios/$items->id/edit") }}'>
									<span class="oi oi-pencil"></span>
								</a>
							</td>
			            </tr>
			        @endforeach
                </tbody>
                
                <tfoot>
	                <tr>
	                 	<th scope="col">#</th>
				        <th scope="col">Nombre</th>
				        <th scope="col">Productos</th>
			            <th scope="col">Acciones</th>
	                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@stop