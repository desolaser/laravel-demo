@extends('admin.layout')

@section('content')
	<div class="box">
        <div class="box-body">
            <table id="tablas" class="table table-bordered table-striped">
                <thead>
                    <tr>
			            <th scope="col">#</th>
			            <th scope="col">Categorías</th>
			        </tr>
                </thead>
                
                <tbody>
                   @foreach($data as $items)
			            <tr>
			                <th scope="row">{{ $items->id }}</th>
			                <td>{{ $items->nombre }}</td>
			            </tr>
			        @endforeach
                </tbody>
                
                <tfoot>
	                <tr>
	                 	<th scope="col">#</th>
				        <th scope="col">Nombre</th>
	                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@stop

