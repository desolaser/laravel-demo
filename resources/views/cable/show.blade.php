@if($data != "[]")
    <div class="bg-info" style="padding: 10px">
        <h4>Cables</h4>
    </div>
    <table id="tablas" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col">Tipo cable</th>
                <th scope="col">Longitud</th>
                <th scope="col">Cantidad</th>
                @if ($status == "OPERACIONES")
                    <th scope="col">Acciones</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <th scope="row">{{ $item->tipo_cable }}</th>
                    <td>{{ $item->longitud }}</td>
                    <td>{{ $item->cantidad }}</td>
                    @if ($status == "OPERACIONES")
                        <td>
                            <a class="btn btn-primary" name="edit-cable" data-id="{{ $item->id }}" data-toggle="modal" data-target="#modal-edicion">
                                <span class="oi oi-pencil"></span>
                            </a>
                            <a class="btn btn-primary" name="del-cable" data-id="{{ $item->id }}">
                                <span class="oi oi-circle-x"></span>
                            </a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
