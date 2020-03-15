@extends('admin.layout')

@section('content')
<h1>Dashboard</h1>
<div class="table-responsive">
    <div class="col-sm-12">
        <p id="date_filter">
            <span id="date-label-from" class="date-label">Desde: </span><input class="date_range_filter date" type="text" id="datepicker_from" />
            <span id="date-label-to" class="date-label">Hasta: </span><input class="date_range_filter date" type="text" id="datepicker_to" />
        </p>
        <table id="tablas" style="font-size:25px">
            <thead>
            <tr>
                <th># Cotización</th>
                <th>Status</th>
                <th>Fecha Ingreso</th>
                <th>Empresa</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->created_at->toDateString() }}</td>
                    <td>{{ $item->empresa->nombre }}</td>
                    <td>
                        <form action="{{ route('cotizaciones.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            @if ($item->status == 'EN_DISEÑO')
                                <a class="btn btn-primary" href="{{ url("dashboard/send/{$item->id}") }}">
                                <i class="icon-shopping-cart icon-large"></i> Enviar a Supervisor</a>
                            @endif
                            @if (($item->status == 'EN_DISEÑO' || $item->status == 'EN_VALIDACIÓN')
                                    || $item->status == 'EN_VALIDACIÓN')
                                <a href="{{ route('cotizaciones.edit', $item->id) }}" class="btn btn-outline-secondary btn-sm">
                                    <span class="oi oi-eye"></span>
                                </a>
                            @endif
                            @if ($item->status == 'EN_VALIDACIÓN')
                                <a class="btn btn-primary" href="{{ url("dashboard/aprove/{$item->id}") }}">
                                <i class="icon-shopping-cart icon-large"></i> Aprobar</a>
                            @endif
                            @if ($item->status == 'EN_VALIDACIÓN')
                                <a class="btn btn-danger" href="{{ url("dashboard/cancel/{$item->id}") }}">
                                <i class="icon-shopping-cart icon-large"></i> Anular</a>
                            @endif
                            @if ($item->status == 'EVALUACIÓN_CLIENTE')
                                <a class="btn btn-danger" href="{{ url("dashboard/reject/{$item->id}") }}">
                                <i class="icon-shopping-cart icon-large"></i> Rechazar</a>
                            @endif
                            @if ($item->status == 'POR_ENVIAR')
                                <a class="btn btn-warning" href="{{ url("sendPdf/{$item->id}") }}">
                                <i class="icon-shopping-cart icon-large"></i> Env.Correo/PDF</a>
                                <button type="button" name="special" class="btn btn-primary btn-sm" data-id="{{ $item->id }}" data-toggle="modal" data-target="#modal-adjuntos">
                                    <i class="fa fa-search"></i> Cotización Especial</a>
                                </button>
                            @endif
                            @if ($item->status == 'EVALUACIÓN_CLIENTE')
                                <a class="btn btn-success" href="{{ url("dashboard/operations/{$item->id}") }}">
                                <i class="icon-shopping-cart icon-large"></i> A operaciones</a>
                            @endif
                            @if ($item->status == 'EVALUACIÓN_CLIENTE' || $item->status == 'POR_ENVIAR')
                                <a class="btn btn-info" href="{{ url("pdf/{$item->id}") }}">
                                <i class="icon-shopping-cart icon-large"></i> Ver pdf</a>
                            @endif
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="modal-adjuntos">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Cotización Especial</h4>
                </div>
                <div class="modal-body">
                    <div id="special-files">
                    </div>
                    <form class="form-group" enctype="multipart/form-data" id="uploadSpecialData" method="POST">
                        <input type="hidden" id="carpeta" name="carpeta"/>
                        <div class="form-group">
                            <input type="file" id="archivo" name="archivo"/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning">Agregar</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <form class="form-group" enctype="multipart/form-data" id="sendSpecialData" method="POST">
                        <input type="hidden" id="carpeta_envio" name="carpeta_envio"/>
                        <input type="hidden" id="cotizacion_id" name="cotizacion_id"/>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Enviar correo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('script')
    <script>
        $(document).on('click', "[name='special']", function() {
            var random_string = Math.random().toString(36).slice(2);
            var cotizacion_id = $(this).data('id');
            $('#carpeta').val(random_string);
            $('#carpeta_envio').val(random_string);
            $('#cotizacion_id').val(cotizacion_id);
        });

        $(document).on('click', "[name='del']", function() {
            var name = $(this).data('name');
            var folder = $('#carpeta').val();
            var token = '{{ csrf_token() }}';
            var data = {name: name, folder: folder, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/dashboard/deleteSpecialData') }}",
                data: data,
                success: function (html) {
                    $("#special-files").empty();
                    $("#special-files").html(html);
                    alert("Archivo eliminado exitosamente");
                }
            });
        });

        $("#uploadSpecialData").on("submit", function(e){
            e.preventDefault();
            var formData = new FormData(document.getElementById("uploadSpecialData"));
            var token = '{{csrf_token()}}';
            formData.append("_token", token);
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "{{ url('/dashboard/uploadSpecialData') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (html) {
                    $("#special-files").empty();
                    $("#special-files").html(html);
                    alert("Archivo agregado exitosamente");
                },
                error:function(){
                    alert("Hubo un fallo al subir el archivo");
                }
            });
        });

        $("#sendSpecialData").on("submit", function(e){
            e.preventDefault();
            var formData = new FormData(document.getElementById("sendSpecialData"));
            var token = '{{csrf_token()}}';
            formData.append("_token", token);
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "{{ url('/dashboard/sendSpecialData') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (html) {
                    alert("Correo enviado exitosamente");
                    location.reload();
                },
                error:function(){
                    alert("Hubo un fallo al enviar el correo");
                }
            });
        });

        $("#modal-adjuntos").on("hidden.bs.modal", function () {
            $("#special-files").empty();
        });
    </script>
@stop
