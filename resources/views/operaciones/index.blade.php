@extends('admin.layout')

@section('content')
    <div class="custom-control custom-checkbox" style="padding-bottom: 10px">
        <select class="custom-select d-block w-100" id="cotizacion_id">
            <option value="">Seleccione cotización</option>
            @foreach($cotizaciones as $items)
                <option value="{{ $items->id }}">{{ $items->id }}</option>
            @endforeach
        </select>
    </div>
	<div class="panel panel-primary col-sm-6">
  		<div class="panel-heading">Cotización Base</div>
  		<div class="panel-body" id="cotizacion_base">
    		Contenido de la cotización ingresada en el módulo anterior
  		</div>
	</div>
        <div class="panel panel-primary col-sm-6">
            <div class="panel-heading">Control ingreso a la empresa</div>
            <div class="panel-body">
                @if (Auth::user()->role == 'DIGITADOR_CIG' || Auth::user()->role == 'SUPERUSUARIO')
                    <a style="margin: 10px" class="btn btn-primary" id="works" href="#" >
                        Ver Trabajos
                    </a>
                @else
                    <a style="margin: 10px" class="btn btn-primary" disabled>
                        Ver Trabajos
                    </a>
                @endif
            </div>
        </div>
	<div class="panel panel-primary col-md-6">
  		<div class="panel-heading">Resumen acumulado productos e insumos</div>
  		<div class="panel-body">
            @if (Auth::user()->role == 'DIGITADOR_CIM' || Auth::user()->role == 'DIGITADOR_IM' ||
                    Auth::user()->role == 'SUPERUSUARIO')
                <a style="margin: 10px" class="btn btn-primary" id="materials" href="#">
                    Añade materiales
                </a>
            @else
                <a style="margin: 10px" class="btn btn-primary" disabled>
                    Añade materiales
                </a>
            @endif
  		</div>
	</div>
	<div class="panel panel-primary col-md-6">
  		<div class="panel-heading">Visualización de datos técnicos</div>
  		<div class="panel-body">
            @if (Auth::user()->role == 'DIGITADOR_DT' || Auth::user()->role == 'SUPERUSUARIO')
                <a style="margin: 10px" class="btn btn-primary" id="tecnicos" href="#">
                    Ver Datos Técnicos
                </a>
            @else
                <a style="margin: 10px" class="btn btn-primary" disabled>
                    Ver Datos Técnicos
                </a>
            @endif
  		</div>
	</div>
	<div class="panel panel-primary col-md-6">
  		<div class="panel-heading">Gastos de operación en terreno</div>
  		<div class="panel-body">
            <div id="gastos_totales">
            </div>
            @if (Auth::user()->role == 'DIGITADOR_CIG' || Auth::user()->role == 'SUPERUSUARIO')
                <a style="margin: 10px" class="btn btn-primary" id="costs" href="#">
                    Ver Gastos
                </a>
            @else
                <a style="margin: 10px" class="btn btn-primary" disabled>
                    Ver Gastos
                </a>
            @endif
  		</div>
	</div>
	<div class="panel panel-danger col-xs-12">
  		<div class="panel-heading">Zona de adjuntos</div>
  		<div class="panel-body">
            <div id="files">
            </div>
            <form class="form-group" enctype="multipart/form-data" id="newFile" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="cotizacion_id" id="file_cotizacion_id">
				<div class="box-body">
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="file" class="form-control" name="archivo" id="archivo" disabled>
                        </div>
                    </div>
                    <div style="margin: 20px" class="form-group col-md-12">
                        <label for="tipo" class="col-sm-2 control-label">Tipo</label>
                        <select class="custom-select d-block w-100" name="tipo" id="tipo" required>
                            <option value="">Seleccione tipo de archivo</option>
                            <option value="GASTOS">Gastos de operación</option>
                            <option value="INFORMES">Informes técnicos</option>
                            <option value="DOCUMENTOS">Documentos varios y logística</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <button style="margin: 5px" type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </div>
            </form>
  		</div>
	</div>
	<div class="panel panel-success col-xs-12">
  		<div class="panel-heading">Zona de chat/foro</div>
  		<div class="panel-body">
            <div id="posts">
            </div>
            <div class="row bg-danger" style="padding: 10px">
                <h4>Crear post</h4>
            </div>
            <form class="form-group" enctype="multipart/form-data" id="newPost" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="cotizacion_id" id="post_cotizacion_id">
				<div class="box-body">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="mensaje" class="col-sm-2 control-label">Texto</label>
                            <textarea class="form-control" name="mensaje" id="mensaje" required></textarea>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <button style="margin: 5px" type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </div>
            </form>
  		</div>
	</div>
	<div class="panel panel-primary col-md-9">
  		<div class="panel-heading">Datos del centro</div>
  		<div class="panel-body" id="info_centro">
		  Nombre y correo encargado, CEL, otro
  		</div>
	</div>
    @if(Auth::user()->role == "SUPERUSUARIO" || Auth::user()->role == "SUPERVISOR" || Auth::user()->role == "DIGITADOR_CIG")
        <div class="panel panel-primary col-md-3">
            <div class="panel-heading">Facturación</div>
            <div class="panel-body">
                <form method="POST" action="{{ url('operaciones/facturar') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="cotizacion_id" id="cerrar_cotizacion_id">
                    <button type="submit" id="cerrar" class="btn btn-primary">Enviar a facturación</a>
                </form>
            </div>
        </div>
    @endif
@stop

@section('script')
    <script>
        function actualizar_datos() {
            var cotizacion_id = $('#cotizacion_id').val();
            if (cotizacion_id == "") return;
            $('#file_cotizacion_id').val(cotizacion_id);
            $('#post_cotizacion_id').val(cotizacion_id);
            $('#materials').attr("href", "materiales/index/"+cotizacion_id);
            $('#works').attr("href", "trabajos/index/"+cotizacion_id);
            $('#costs').attr("href", "gastos/index/"+cotizacion_id);
            $('#tecnicos').attr("href", "tecnicos/index/"+cotizacion_id);
            $('#cerrar_cotizacion_id').val(cotizacion_id);
            $("#archivo").prop('disabled', false);

            var token = '{{csrf_token()}}';
            var data = {cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/operaciones/resumedBudget') }}",
                data: data,
                success: function (data) {
                    $("#cotizacion_base").empty();
                    $("#cotizacion_base").html(data);
                }
            });

			var token = '{{csrf_token()}}';
            var data = {cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/operaciones/getinfoCentros') }}",
                data: data,
                success: function (data) {
                    $("#info_centro").empty();
                    $("#info_centro").html(data);
                }
            });

			var token = '{{csrf_token()}}';
            var data = {cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/operaciones/getBudgetFiles') }}",
                data: data,
                success: function (data) {
                    $("#files").empty();
                    $("#files").html(data);
                }
            });

			var token = '{{csrf_token()}}';
            var data = {cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/operaciones/getTotalCost') }}",
                data: data,
                success: function (data) {
                    $("#gastos_totales").html("Gastos totales: " + data['gasto_total']);
                }
            });

			var token = '{{csrf_token()}}';
            var data = {cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/posts/show') }}",
                data: data,
                success: function (data) {
                    $("#posts").empty();
                    $("#posts").html(data);
                }
            });
        }

        $(document).ready(function () {
            //$("div.alert").remove();
            actualizar_datos();
        });

        $("#cotizacion_id").change(function (e) {
            e.preventDefault();
            actualizar_datos();
        });

        $("#newFile").on("submit", function(e){
            e.preventDefault();

            var formData = new FormData(document.getElementById("newFile"));
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "{{ url('/operaciones/newFile') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#files").empty();
                    $("#files").html(data);
                    setTimeout(function(){
                        $("div.alert").fadeOut();
                    }, 5000 );
                }
            });
        });

        $("#newPost").on("submit", function(e){
            e.preventDefault();

            var formData = new FormData(document.getElementById("newPost"));
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "{{ url('/posts/store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#posts").empty();
                    $("#posts").html(data);
                    setTimeout(function(){
                        $("div.alert").fadeOut();
                    }, 5000 );
                }
            });
        });

        $(document).on('click', "[name='del_file']", function() {
            var id = $(this).data('id');
            var cotizacion_id = $('#cotizacion_id').val();
            var token = '{{csrf_token()}}';
            var data = {id: id, cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/operaciones/deleteFile') }}",
                data: data,
                success: function (data) {
                    $("#files").empty();
                    $("#files").html(data);
                    setTimeout(function(){
                        $("div.alert").fadeOut();
                    }, 5000 );
                }
            });
        });

        $(document).on('click', "[name='del_post']", function() {
            var id = $(this).data('id');
            var cotizacion_id = $('#cotizacion_id').val();
            var token = '{{csrf_token()}}';
            var data = {id: id, cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/posts/delete') }}",
                data: data,
                success: function (data) {
                    $("#posts").empty();
                    $("#posts").html(data);
                    setTimeout(function(){
                        $("div.alert").fadeOut();
                    }, 5000 );
                }
            });
        });
    </script>
@stop
