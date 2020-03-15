@extends('admin.layout')

@section('content')
	<div class="box">
		<a href="{{ url('contactos/create')}}" class="btn btn-sm btn-primary">Agregar nuevo registro</a>
        <div class="box-body">
            <table id="tablas" class="table table-bordered table-striped">
                <thead>
                    <tr>
			            <th scope="col">#</th>
			            <th scope="col">Empresa</th>
			            <th scope="col">Centro</th>
			            <th scope="col">Nombre</th>
			            <th scope="col">Cargo</th>
			            <th scope="col">Zona</th>
			            <th scope="col">Email</th>
			            <th scope="col">Móvil</th>
			            <th scope="col">Oficina</th>
			            <th scope="col">Acciones</th>
			        </tr>
                </thead>
                
                <tbody>
                   @foreach($data as $items)
			            <tr>
			                <th scope="row">{{ $items->id }}</th>
			                <td>{{ $items->empresa->nombre }}</td>
			                <td>{{ $items->centro->nombre }}</td>
			                <td>{{ $items->nombre }}</td>
			                <td>{{ $items->cargo }}</td>
			                <td>{{ $items->zona }}</td>
			                <td>{{ $items->email }}</td>
			                <td>{{ $items->movil }}</td>
			                <td>{{ $items->oficina }}</td>
			                <td>
			                	<form action="{{ route('contactos.destroy', $items->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <a href="{{ route('contactos.edit', $items->id) }}"">
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
			            <th scope="col">Empresa</th>
			            <th scope="col">Centro</th>
			            <th scope="col">Nombre</th>
			            <th scope="col">Cargo</th>
			            <th scope="col">Zona</th>
			            <th scope="col">Email</th>
			            <th scope="col">Móvil</th>
			            <th scope="col">Oficina</th>
			            <th scope="col">Acciones</th>
	                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@stop

