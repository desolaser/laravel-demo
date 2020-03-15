@extends('admin.layout')

@section('content')
	<div class="col-md-12">
		<div class="box box-info">

			@include('shared._errors')
			<form action="{{ url('facturas/store') }}" method="POST" class="form-horizontal">
				@csrf
        <input type="hidden" name="id_unique" id="id_unique" value="{{ $id_unique }}">
				<div class="box-body col-sm-6">
          <div class="form-group">
						<label for="empresa_id" class="col-sm-2 control-label">Empresa</label>
						<div class="col-sm-10">
							<select name="empresa_id" id="empresa_id" class="form-control">
						        <option value="">Seleccione una Empresa</option>
						        @foreach($empresas as $item)
						        	<option value="{{ $item->id }}" {{ old('empresa_id') == $item->id ? 'selected' : '' }}>
						                {{ $item->nombre }}
						            </option>
						        @endforeach
						  </select>
						</div>
					</div>

					<div class="form-group">
						<label for="monto" class="col-sm-2 control-label">Monto</label>
						<div class="col-sm-10">
							<input type="number" class="form-control" id="monto" name="monto" value="{{ old('monto') }}" required>
						</div>
					</div>

          <div class="form-group">
						<label for="fecha" class="col-sm-2 control-label">Fecha</label>
						<div class="col-sm-10">
							<input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha') }}" required>
						</div>
					</div>

					<div class="form-group">
						<label for="resumen" class="col-sm-2 control-label">Resumen</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="resumen" name="resumen" value="{{ old('resumen') }}" required>
						</div>
					</div>

					<div class="form-group">
						<label for="numero_factura_sii" class="col-sm-2 control-label">N° Factura SII</label>
						<div class="col-sm-10">
							<input type="number" class="form-control" id="numero_factura_sii" name="numero_factura_sii" value="{{ old('numero_factura_sii') }}" required>
						</div>
					</div>
				</div>

				<div class="box-footer col-sm-12">
					<a href="{{ route('facturas.create')}}" class="btn btn-default">Cancelar</a>
					<button type="submit" class="btn btn-primary pull-right">Guardar</button>
				</div>
			</form>


            <div class="box-body col-sm-6">
                <div class="panel panel-primary col-xs-12">
                    <div class="panel-heading">Zona de adjuntos</div>
                    <div class="panel-body">
                        <div id="files">
                        </div>
                        <form class="form-group" enctype="multipart/form-data" id="newFile" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_unique" id="id_unique" value="{{ $id_unique }}">
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="file" class="form-control" name="archivo" id="archivo">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <button style="margin: 5px" type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="box-body col-sm-6">
                <div class="panel panel-primary col-xs-12">
                    <div class="panel-heading">Zona de cotización</div>
                    <div class="panel-body">
                        <div id="cotizaciones">
                        </div>
                        <form class="form-group" enctype="multipart/form-data" id="newCotizacion" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_unique" id="id_unique" value="{{ $id_unique }}">
                            <div class="box-body">
                                <div class="form-group col-sm-12 row">
                                    <select name="cotizacion_id" id="cotizacion_id" class="form-control">
                                        <option value="">Seleccione una cotización</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <button id="add_budget" style="margin: 5px" type="submit" class="btn btn-primary pull-right">Agregar Cotización</button>
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
        $("#newFile").on("submit", function(e){
            e.preventDefault();

            var formData = new FormData(document.getElementById("newFile"));
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "{{ url('/facturas/newFile') }}",
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

        $(document).on('click', "[name='del_file']", function() {
            var id = $(this).data('id');
            var id_unique = $('#id_unique').val();
            var token = '{{csrf_token()}}';
            var data = {id: id, id_unique: id_unique, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/facturas/deleteFile') }}",
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

         $("#newCotizacion").on("submit", function(e){
            e.preventDefault();

            var formData = new FormData(document.getElementById("newCotizacion"));
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "{{ url('/facturas/newCotizacion') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#cotizaciones").empty();
                    $("#cotizaciones").html(data);
                    setTimeout(function(){
                        $("div.alert").fadeOut();
                    }, 5000 );
                }
            });
        });

        $(document).on('click', "[name='del_cotizacion']", function() {
            var id = $(this).data('id');
            var id_unique = $('#id_unique').val();
            var token = '{{csrf_token()}}';
            var data = {id: id, id_unique: id_unique, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/facturas/deleteCotizacion') }}",
                data: data,
                success: function (data) {
                    $("#cotizaciones").empty();
                    $("#cotizaciones").html(data);
                    setTimeout(function(){
                        $("div.alert").fadeOut();
                    }, 5000 );
                }
            });
        });

				$('#empresa_id').change(function (e) {
            e.preventDefault();

            var empresa_id = $(this).val();
            var token = '{{csrf_token()}}';
            var data = {empresa_id: empresa_id, _token: token};

            $.ajax({
                type: "post",
                url: "{{ url('facturas/getCotizaciones/') }}",
                data: data,
                success: function (data) {
                    $("#cotizacion_id").empty();
                    $("#cotizacion_id").append('<option value="">Seleccione una cotización</option>');
                    $.each(data, function(i, item){
                        $("#cotizacion_id").append('<option value='+data[i].id+'>'+data[i].id+'</option>');
                    })
                }
            });
        });
    </script>
@stop
