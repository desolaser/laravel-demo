@if($data != "[]")
<table id="tablas" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th scope="col">Intervención</th>
            <th scope="col">OT</th>
            <th scope="col">GD</th>
            <th scope="col">fecha_ingreso</th>
            <th scope="col">fecha_retorno</th>
            <th scope="col">trabajadores</th>
            @if ($status == "OPERACIONES")
                <th scope="col">Acciones</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
            <tr>
                <th scope="row">{{ $item->motivo }}</th>
                <td>{{ $item->OT }}</td>
                <td>{{ $item->GD }}</td>
                <td>{{ $item->fecha_ingreso }}</td>
                <td>{{ $item->fecha_retorno }}</td>
                <td>
                    <ul>
                        @foreach($item->trabajadores as $trabajador)
                            <li>{{ $trabajador->nombre }}</li>
                        @endforeach
                    </ul>
                </td>
                @if ($status == "OPERACIONES")
                    <td>
                        <a class="btn btn-primary" name="edit" data-id="{{ $item->id }}" data-toggle="modal" data-target="#modal-edicion">
                            <span class="oi oi-pencil"></span>
                        </a>
                        <a class="btn btn-primary" name="trabajadores" data-id="{{ $item->id }}" data-toggle="modal" data-target="#modal-trabajadores">
                            <span class="oi oi-people"></span>
                        </a>
                        <a class="btn btn-primary" name="del" data-id="{{ $item->id }}">
                            <span class="oi oi-circle-x"></span>
                        </a>
                    </td>
                @endif
        @endforeach
    </tbody>
</table>
@else
    <div style="padding: 20px">
        </h3>No hay trabajos asociados a esta cotización</h3>
    </div>
@endif
