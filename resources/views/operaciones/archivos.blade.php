<style>
    .data{
        float: left;
        padding: 10px;
        margin: 10px;
        width: 80%;
        background-color: #EEEEEE;
    }
    .data-button{
        float: right;
        padding: 9px;
        margin: 10px;
        width: 5%;
    }
</style>

@php
if (isset($alerts)) {
    echo $alerts;
}
@endphp
@if($gastos != "[]")
    <h4>Gastos de operación</h4>
    @foreach($gastos as $gasto)
        <div class="file-item col-sm-12">
            <div class="data">
                <a name="get_file" href="{{ url("operaciones/getFile/{$gasto->id}") }}">
                    {{ $gasto->nombre }}
                </a>
            </div>
            @if ($status == "OPERACIONES")
                <a class="btn btn-primary data-button" name="del_file" data-id="{{ $gasto->id }}">
                    <span class="oi oi-circle-x"></span>
                </a>
            @endif
        </div>
    @endforeach
@else
    <p>No hay gastos de operaciones en esta cotización</p>
@endif

@if($informes != "[]")
    <h4>Informes técnicos</h4>
    @foreach($informes as $informe)
        <div class="file-item col-sm-12">
            <div class="data">
                <a name="get_file" href="{{ url("operaciones/getFile/{$informe->id}") }}">
                    {{ $informe->nombre }}
                </a>
            </div>
            @if ($status == "OPERACIONES")
                <a class="btn btn-primary data-button" name="del_file" data-id="{{ $informe->id }}">
                    <span class="oi oi-circle-x"></span>
                </a>
            @endif
        </div>
    @endforeach
@else
    <p>No hay informes en esta cotización</p>
@endif

@if($documentos != "[]")
    <h4>Documentos varios y logística</h4>
    @foreach($documentos as $documento)
        <div class="file-item col-sm-12">
            <div class="data">
                <a name="get_file" href="{{ url("operaciones/getFile/{$documento->id}") }}">
                    {{ $documento->nombre }}
                </a>
            </div>
            @if ($status == "OPERACIONES")
                <a class="btn btn-primary data-button" name="del_file" data-id="{{ $documento->id }}">
                    <span class="oi oi-circle-x"></span>
                </a>
            @endif
        </div>
    @endforeach
@else
    <p>No hay documentos en esta cotización</p>
@endif
