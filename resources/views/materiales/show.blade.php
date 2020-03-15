@if($data != "[]")
<table id="tablas" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th scope="col">Producto</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Proveedor</th>
            <th scope="col">Precio proveedor</th>
            <th scope="col">Solicitante</th>
            <th scope="col">Fecha ingreso</th>
            @if ($status == "OPERACIONES")
                <th scope="col">Acciones</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
            <tr>
                <td>{{ $item->producto }}</td>
                <td>{{ $item->cantidad }}</td>
                <td>{{ $item->proveedor }}</td>
                <td>{{ $item->p_proveedor }}</td>
                <td>{{ $item->solicitante }}</td>
                <td>{{ $item->created_at->toDateString() }}</td>
                @if ($status == "OPERACIONES")
                    <td>
                        <a class="btn btn-primary" name="edit" data-id="{{ $item->id }}" data-toggle="modal" data-target="#modal-edicion">
                            <span class="oi oi-pencil"></span>
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
        </h3>No hay materiales asociados a esta cotización</h3>
    </div>
@endif
