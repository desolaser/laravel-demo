@extends('admin.layout')

@section('content')
    <div class="box">
        <a href="{{ url('trabajadores/create')}}" class="btn btn-sm btn-primary">Agregar nuevo registro</a>
        <div class="box-body">
            <table id="tablas" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">RUT</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($trabajadores as $trabajador)
                        <tr>
                            <th scope="row">{{ $trabajador->id }}</th>
                            <td>{{ $trabajador->nombre }}</td>
                            <td>{{ $trabajador->rut }}</td>
                            <td>
                                <form action="{{ route('trabajadores.destroy', $trabajador->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <a href="{{ route('trabajadores.edit', $trabajador->id) }}" class="btn btn-outline-secondary btn-sm">
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
                        <th scope="col">Nombre</th>
                        <th scope="col">RUT</th>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
@stop