@if($data != "[]")
    @php
        $i = 0
    @endphp
    @foreach($data as $item)
        <div class="bg-info" style="padding: 10px">
            <h4>Intervención: {{ $trabajos[$i]->motivo }}</h4>
        </div>
        <table id="tablas" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Gasto</th>
                    <th scope="col">Número boleta</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Fecha</th>
                    @if ($status == "OPERACIONES")
                        <th scope="col">Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($item as $gasto)
                    <tr>
                        <th scope="row">{{ $gasto->nombre }}</th>
                        <td>{{ $gasto->gasto }}</td>
                        <td>{{ $gasto->numero_boleta }}</td>
                        <td>{{ $gasto->tipo }}</td>
                        <td>{{ $gasto->fecha }}</td>
                        @if ($status == "OPERACIONES")
                            <td>
                                <a class="btn btn-primary" name="edit" data-id="{{ $gasto->id }}" data-toggle="modal" data-target="#modal-edicion">
                                    <span class="oi oi-pencil"></span>
                                </a>
                                <a class="btn btn-primary" name="del" data-id="{{ $gasto->id }}">
                                    <span class="oi oi-circle-x"></span>
                                </a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        @php
            $i++
        @endphp
    @endforeach
@else
    <div style="padding: 20px">
        </h3>No hay gastos asociados a este trabajo</h3>
    </div>
@endif
