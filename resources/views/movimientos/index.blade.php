@extends('admin.layout')

@section('content')
	<div class="box">
        <div class="box-body">
            <table id="tablas" class="table table-bordered table-striped">
                <thead>
                    <tr>
			            <th scope="col">#</th>
			            <th scope="col">Nombre</th>
			            <th scope="col">Acciones</th>
			        </tr>
                </thead>

                <tbody>
                   @foreach($data as $empresa)
			            <tr>
			                <th scope="row">{{ $empresa->id }}</th>
			                <td>{{ $empresa->nombre }}</td>
			                <td>
								<a href="{{ url("movimientos/account/{$empresa->id}") }}" class="btn btn-primary btn-sm">
									Ver cuenta
								</a>
			                </td>
			        @endforeach
                </tbody>

                <tfoot>
	                <tr>
	                	<th scope="col">#</th>
			            <th scope="col">Nombre</th>
			            <th scope="col">Acciones</th>
	                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@stop
