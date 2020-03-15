@extends('admin.layout')

@section('content')
    <div class="box">
		<a href="{{ url('centros/create')}}" class="btn btn-sm btn-primary">Agregar nuevo registro</a>
        <div class="box-body">
            <table id="tablas" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Empresa</th>
                        <th scope="col">Centro</th>
                        <th scope="col">Zona</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                
                <tbody>
                   @foreach($centros as $centro)
                        <tr>
                            <th scope="row">{{ $centro->id }}</th>
                            <td>{{ $centro->empresa->nombre }}</td>
                            <td>{{ $centro->nombre }}</td>
                            @if($centro->zona == 0)
                                <td class="text-danger">Sin zona</td>
                            @else
                                <td>{{ $centro->zona }}</td>
                            @endif
                            <td>
                                <form action="{{ route('centros.destroy', $centro) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <a href="{{ route('centros.edit', $centro) }}" class="btn btn-outline-secondary btn-sm">
                                        <span class="oi oi-pencil"></span>
                                    </a>

                                    <button type="submit" class="btn btn-sm">
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
                        <th scope="col">Zona</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@stop