@if($data != "[]")
    <div class="bg-info" style="padding: 10px">
        <h4>Computadores</h4>
    </div>
    <table id="tablas" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col">Serial</th>
                <th scope="col">Modelo</th>
                <th scope="col">Tipo</th>
                <th scope="col">Placa madre</th>
                <th scope="col">Fuente de poder</th>
                <th scope="col">Procesador</th>
                <th scope="col">Teclado</th>
                <th scope="col">Mouse</th>
                <th scope="col">Ram</th>
                <th scope="col">Disco duro</th>
                <th scope="col">Tarjeta Video</th>
                <th scope="col">Wifi</th>
                @if ($status == "OPERACIONES")
                    <th scope="col">Acciones</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <th scope="row">{{ $item->serial }}</th>
                    <td>{{ $item->modelo }}</td>
                    <td>{{ $item->tipo }}</td>
                    <td>{{ $item->placa_madre }}</td>
                    <td>{{ $item->fuente_poder }}</td>
                    <td>{{ $item->procesador }}</td>
                    <td>{{ $item->teclado }}</td>
                    <td>{{ $item->mouse }}</td>
                    <td>{{ $item->ram }}</td>
                    <td>{{ $item->disco_duro }}</td>
                    <td>{{ $item->tarjeta_video }}</td>
                    <td>{{ $item->wifi }}</td>
                    @if ($status == "OPERACIONES")
                        <td>
                            <a class="btn btn-primary" name="edit-pc" data-id="{{ $item->id }}" data-toggle="modal" data-target="#modal-edicion">
                                <span class="oi oi-pencil"></span>
                            </a>
                            <a class="btn btn-primary" name="del-pc" data-id="{{ $item->id }}">
                                <span class="oi oi-circle-x"></span>
                            </a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
