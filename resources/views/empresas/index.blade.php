@extends('admin.layout')

@section('content')
	<div class="box">
		<a href="{{ url('empresas/create')}}" class="btn btn-sm btn-primary">Agregar nuevo registro</a>
        <div class="box-body">
            <table id="tablas" class="table table-bordered table-striped">
                <thead>
                    <tr>
			            <th scope="col">#</th>
			            <th scope="col">Nombre</th>
			            <th scope="col">Iniciales</th>
			            <th scope="col">Centros</th>
			            <th scope="col">Acciones</th>
			        </tr>
                </thead>
                
                <tbody>
                   @foreach($empresas as $empresa)
			            <tr>
			                <th scope="row">{{ $empresa->id }}</th>
			                <td>{{ $empresa->nombre }}</td>
			                <td>{{ $empresa->iniciales }}</td>
			                @if($empresa->centros_count == 0)
			                	<td class="text-danger">Sin centros</td>
			                @else
			                	<td>{{ $empresa->centros_count }}</td>
			                @endif
			                <td>
			                	<form action="{{ route('empresas.destroy', $empresa) }}" method="POST">
					                @csrf
					                @method('DELETE')
									
					                <a href="{{ route('empresas.edit', $empresa) }}" class="btn btn-outline-secondary btn-sm">
					                	<span class="oi oi-pencil"></span>
					                </a>

					                <button type="submit" class="btn btn-sm">
					                	<span class="oi oi-trash"></span>
					                </button>
					            </form>
			                </td>
			        @endforeach
                </tbody>
                
                <tfoot>
	                <tr>
	                	<th scope="col">#</th>
			            <th scope="col">Nombre</th>
			            <th scope="col">Iniciales</th>
			            <th scope="col">Centros</th>
			            <th scope="col">Acciones</th>
	                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@stop



