@if($data != "[]")
    <div class="bg-info" style="padding: 10px">
        <h4>Dvr's</h4>
    </div>
    <table id="tablas" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col">Serial</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
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
                    @if ($status == "OPERACIONES")
                        <td>
                            <a class="btn btn-primary" name="edit-dvr" data-id="{{ $item->id }}" data-toggle="modal" data-target="#modal-edicion">
                                <span class="oi oi-pencil"></span>
                            </a>
                            <a class="btn btn-primary" name="del-dvr" data-id="{{ $item->id }}">
                                <span class="oi oi-circle-x"></span>
                            </a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
