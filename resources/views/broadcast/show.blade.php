@if($data != "[]")
    <div class="bg-info" style="padding: 10px">
        <h4>Broadcast</h4>
    </div>
    <table id="tablas" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col">Serial</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th scope="col">Usuario</th>
                <th scope="col">Clave</th>
                <th scope="col">Serial P2P</th>
                <th scope="col">IP</th>
                <th scope="col">Mac address</th>
                <th scope="col">Nombre</th>
                <th scope="col">Firmware</th>
                <th scope="col">Backup</th>
                <th scope="col">Número producción</th>
                <th scope="col">Número cámaras</th>
                @if ($status == "OPERACIONES")
                    <th scope="col">Acciones</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <th scope="row">{{ $item->serial }}</th>
                    <td>{{ $item->marca }}</td>
                    <td>{{ $item->modelo }}</td>
                    <td>{{ $item->usuario }}</td>
                    <td>{{ $item->clave }}</td>
                    <td>{{ $item->serial_p2p }}</td>
                    <td>{{ $item->ip }}</td>
                    <td>{{ $item->mac_address }}</td>
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->firmware }}</td>
                    <td>{{ $item->backup }}</td>
                    <td>{{ $item->numero_produccion }}</td>
                    <td>{{ $item->numero_camaras }}</td>
                    @if ($status == "OPERACIONES")
                        <td>
                            <a class="btn btn-primary" name="edit-broadcast" data-id="{{ $item->id }}" data-toggle="modal" data-target="#modal-edicion">
                                <span class="oi oi-pencil"></span>
                            </a>
                            <a class="btn btn-primary" name="del-broadcast" data-id="{{ $item->id }}">
                                <span class="oi oi-circle-x"></span>
                            </a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
