@extends('admin.layout')

@section('content')
	<div class="box">
		<a href="{{ url('productos/create')}}" class="btn btn-sm btn-primary">Agregar nuevo registro</a>
        <div class="box-body">
            <table id="tablas" class="table table-bordered table-striped">
                <thead>
                    <tr>
			            <th scope="col">#</th>
			            <th scope="col">Servicio</th>
			            <th scope="col">Categoria</th>
			            <th scope="col">Productos</th>
			            <th scope="col">Unidad</th>
			            <th scope="col">Precio</th>
			            <th scope="col">Acciones</th>
			        </tr>
                </thead>
                
                <tbody>
                   @foreach($data as $items)
			            <tr>
			                <th scope="row">{{ $items->id }}</th>
			                <td>{{ $items->servicio->nombre }}</td>
			                <td>{{ $items->categoria->nombre }}</td>
			                <td>{{ $items->nombre }}</td>
			                <td>{{ $items->unidad }}</td>
			                <td>{{ $items->precio }}</td>
			                <td>
			                	<form action="{{ route('productos.destroy', $items->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <a href='{{ url("productos/$items->id/edit") }}'>
                                        <span class="oi oi-pencil"></span>
                                    </a>

                                    <button type="submit">
                                        <span class="oi oi-trash"></span>
                                    </button>
                                </form>
			                </td>
			            </tr>
			        @endforeach
                </tbody>
                
                <tfoot>
	                <tr>
	                 	<th scope="col">#</th>
			            <th scope="col">Servicio</th>
			            <th scope="col">Categoria</th>
			            <th scope="col">Nombre</th>
			            <th scope="col">Unidad</th>
			            <th scope="col">Precio</th>
			            <th scope="col">Acciones</th>
	                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@stop

