@extends('admin.layout')

@section('content')
	<div class="col-md-12">
		<div class="box box-info">

			@include('shared._errors')

			<form action="{{ url('transferencias/store') }}" method="POST" class="form-horizontal">
				@csrf
				<input type="hidden" name="id_unique" id="id_unique" value="{{ $id_unique }}">
				<input type="hidden" name="empresa_id" id="empresa_id" value="{{ $empresa_id }}">
				<div class="box-body col-sm-6">
					<div class="form-group">
						<label for="tipo_pago" class="col-sm-2 control-label">Tipo de Pago</label>
						<div class="col-sm-10">
							<select name="tipo_pago" id="tipo_pago" class="form-control">
									<option value="">Seleccione un tipo de pago</option>
									<option value="EFECTIVO">Efectivo</option>
									<option value="TRANSFERENCIA">Transferencia</option>
									<option value="CHEQUE">Cheque</option>
									<option value="OTROS">Otros</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="razon_social" class="col-sm-2 control-label">Fecha</label>
						<div class="col-sm-10">
							<input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha') }}" required>
						</div>
					</div>
					<div class="form-group">
						<label for="monto" class="col-sm-2 control-label">Monto</label>
						<div class="col-sm-10">
							<input type="number" class="form-control" id="monto" name="monto" value="{{ old('monto') }}" required>
						</div>
					</div>
					<div id="div-banco" class="form-group">
						<label for="banco" class="col-sm-2 control-label">Banco</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="banco" name="banco" value="{{ old('banco') }}">
						</div>
					</div>
					<div id="div-numero_cheque" class="form-group">
						<label for="numero_cheque" class="col-sm-2 control-label">N煤mero cheque</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="numero_cheque" name="numero_cheque" value="{{ old('numero_cheque') }}">
						</div>
					</div>
					<div id="div-codigo_transferencia" class="form-group">
						<label for="codigo_transferencia" class="col-sm-2 control-label">C贸digo transferencia</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="codigo_transferencia" name="codigo_transferencia" value="{{ old('codigo_transferencia') }}">
						</div>
					</div>
				</div>
				<div class="box-footer col-sm-12">
					<a href="{{ route('movimientos.index')}}" class="btn btn-default">Cancelar</a>
					<button type="submit" class="btn btn-primary pull-right">Registrar Transferencia</button>
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
              <div class="panel-heading">Zona de facturas</div>
              <div class="panel-body">
                  <div id="bills">
                  </div>
                  <form class="form-group" enctype="multipart/form-data" id="newBill" method="POST">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="id_unique" id="id_unique" value="{{ $id_unique }}">
                      <div class="box-body">
                          <div class="form-group col-sm-12 row">
                              <select name="factura_id" id="factura_id" class="form-control">
                                  <option value="">Seleccione una factura</option>
                                  @foreach($facturas as $items)
								  @if ($items->transferencia_id == NULL)
									<option value="{{ $items->id }}">{{ $items->numero_factura_sii }}</option>
                                  @endif
                                  @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="form-group col-md-6">
                          <button id="add_bill" style="margin: 5px" type="submit" class="btn btn-primary pull-right">Agregar Factura</button>
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
	      $(document).ready(function () {
						$("#div-banco").hide();
						$("#div-numero_cheque").hide();
						$("#div-codigo_transferencia").hide();
        });

				$("#newFile").on("submit", function(e){
						e.preventDefault();

						var formData = new FormData(document.getElementById("newFile"));
						$.ajax({
								type: "POST",
								dataType: "html",
								url: "{{ url('/transferencias/newFile') }}",
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
								url: "{{ url('/transferencias/deleteFile') }}",
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

				$("#newBill").on("submit", function(e){
						e.preventDefault();

						var formData = new FormData(document.getElementById("newBill"));
						$.ajax({
								type: "POST",
								dataType: "html",
								url: "{{ url('/transferencias/newBill') }}",
								data: formData,
								cache: false,
								contentType: false,
								processData: false,
								success: function (data) {
										$("#bills").empty();
										$("#bills").html(data);
										setTimeout(function(){
												$("div.alert").fadeOut();
										}, 5000 );
								}
						});
				});

				$(document).on('click', "[name='del_bill']", function() {
						var id = $(this).data('id');
						var id_unique = $('#id_unique').val();
						var token = '{{csrf_token()}}';
						var data = {id: id, id_unique: id_unique, _token: token};
						$.ajax({
								type: "POST",
								url: "{{ url('/transferencias/deleteBill') }}",
								data: data,
								success: function (data) {
										$("#bills").empty();
										$("#bills").html(data);
										setTimeout(function(){
												$("div.alert").fadeOut();
										}, 5000 );
								}
						});
				});

				$("#tipo_pago").change(function (e) {
            e.preventDefault();

						var value = $(this).val();
						switch(value) {
                case "EFECTIVO":
                    $("#div-banco").hide();
                    $("#div-numero_cheque").hide();
                    $("#div-codigo_transferencia").hide();
                break;
                case "TRANSFERENCIA":
                    $("#div-banco").show();
                    $("#div-numero_cheque").hide();
                    $("#div-codigo_transferencia").show();
                break;
                case "CHEQUE":
                    $("#div-banco").show();
                    $("#div-numero_cheque").show();
                    $("#div-codigo_transferencia").hide();
                break;
                case "OTROS":
                    $("#div-banco").hide();
                    $("#div-numero_cheque").hide();
                    $("#div-codigo_transferencia").hide();
                break;
            }
        });
		</script>
@stop
