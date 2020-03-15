@extends('admin.layout')

@section('content')
	@csrf
    @method('DELETE')
    @if ($role == 'SUPERUSUARIO')
	<div class="box">
		<a href="{{ url('users/create') }}" class="btn btn-sm btn-primary">Agregar nuevo registro</a>
        <div class="box-body">
            <table id="tablas" class="table table-bordered table-striped">
                <thead>
                    <tr>
			            <th scope="col">#</th>
			            <th scope="col">Nombre</th>
			            <th scope="col">Email</th>
			            <th scope="col">Rol</th>
			            <th scope="col">Acciones</th>
			        </tr>
                </thead>
                
                <tbody>
                   @foreach($data as $items)
			            <tr>
			                <th scope="row">{{ $items->id }}</th>
			                <td>{{ $items->name }}</td>
			                <td>{{ $items->email }}</td>
			                <td>{{ $items->role }}</td>
			                <td>
			                	<form action="{{ route('users.destroy', $items->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <a href='{{ url("users/$items->id/edit") }}'>
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
				        <th scope="col">Nombre</th>
			            <th scope="col">Email</th>
			            <th scope="col">Rol</th>
			            <th scope="col">Acciones</th>
	                </tr>
                </tfoot>
            </table>
        </div>
    </div>
	@endif
@stop

