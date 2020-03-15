@extends('admin.layout')

@section('content')
    <div class="box">
        <a href="{{ url('notas/create')}}" class="btn btn-sm btn-primary">Agregar nuevo registro</a>
        <div class="box-body">
            <table id="tablas" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Detalle</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($notas as $item)
                        <tr>
                            <th scope="row">{{ $item->id }}</th>
                            <td>{{ $item->detalle }}</td>
                            <td>
                                <form action="{{ route('notas.destroy', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <a href='{{ url("notas/$item->id/edit") }}'>
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
                        <th scope="col">Detalle</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
@stop