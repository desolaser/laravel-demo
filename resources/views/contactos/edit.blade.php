@extends('admin.layout')

@section('content')
	<div class="col-md-10">
		<div class="box box-info">

			@include('shared._errors')

			<form action="{{ url("contactos/{$data->id}") }}" method="POST" class="form-horizontal">
				@csrf
                @method('PUT')
				<div class="box-body">
					<div class="form-group">
                        <input type="hidden" class="form-control" id="data" name="data" value="{{ $data }}">
						<label for="empresa_id" class="col-sm-2 control-label">Empresa</label>
						<div class="col-sm-10">
							<select name="empresa_id" id="empresa_id" class="form-control">
						        <option value="">Seleccione una Empresa</option>
						        @foreach($empresas as $item)
						        	<option value="{{ $item->id }}" {{ old('empresa_id', $data->empresa_id == $item->id) ? 'selected' : '' }}>
						                {{ $item->nombre }}
						            </option>
						        @endforeach
						    </select>
						</div>
					</div>
					<div class="form-group">
						<label for="centro_id" class="col-sm-2 control-label">Centro</label>
						<div class="col-sm-10">
							<select name="centro_id" id="centro_id" class="form-control">
						        <option value="" required>Seleccione un Centro</option>
						    </select>
						</div>
					</div>
					<div class="form-group">
						<label for="nombre" class="col-sm-2 control-label">Nombre</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="nombre" name="nombre" required>
						</div>
					</div>
					<div class="form-group">
						<label for="cargo" class="col-sm-2 control-label">Cargo</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="cargo" name="cargo" required>
						</div>
					</div>
					<div class="form-group">
						<label for="zona" class="col-sm-2 control-label">Zona</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="zona" name="zona" required>
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="email" name="email" required>
						</div>
					</div>
					<div class="form-group">
						<label for="movil" class="col-sm-2 control-label">Móvil</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="movil" name="movil" required>
						</div>
					</div>
					<div class="form-group">
						<label for="oficina" class="col-sm-2 control-label">Oficina</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="oficina" name="oficina" required>
						</div>
					</div>
					<div class="box-footer">
						<a href="{{ route('contactos.index')}}" class="btn btn-default">Cancelar</a>
						<button type="submit" class="btn btn-primary pull-right">Grabar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@stop

@section('script')
    <script>
        $("document").ready(function () {
            var empresa_id = $('#empresa_id').val();
            var token = '{{csrf_token()}}';
            var data = {empresa_id: empresa_id, _token: token};

            $.ajax({
                type: "post",
                url: "{{ url('cotizaciones/getCentros/') }}",
                data: data,
                success: function (data) {
                    $("#centro_id").empty();
                    $("#centro_id").append('<option value="">Seleccione centro</option>');
                    $.each(data, function(i, item){
                        $("#centro_id").append('<option value='+data[i].id+'>'+data[i].nombre+'</option>');
                    })                    
                    var contact_data = JSON.parse($("#data").val());
                    $("#centro_id").val(contact_data.centro_id);
                    $("#nombre").val(contact_data.nombre);
                    $("#cargo").val(contact_data.cargo);
                    $("#zona").val(contact_data.zona);
                    $("#email").val(contact_data.email);
                    $("#movil").val(contact_data.movil);
                    $("#oficina").val(contact_data.oficina);
                }
            });
        });
        
        $("#empresa_id").change(function (e) {
            e.preventDefault();
            var empresa_id = $('#empresa_id').val();
            var token = '{{csrf_token()}}';
            var data = {empresa_id: empresa_id, _token: token};

            $.ajax({
                type: "post",
                url: "{{ url('cotizaciones/getCentros/') }}",
                data: data,
                success: function (data) {
                    $("#centro_id").empty();
                    $("#centro_id").append('<option value="">Seleccione centro</option>');
                    $.each(data, function(i, item){
                        $("#centro_id").append('<option value='+data[i].id+'>'+data[i].nombre+'</option>');
                    })
                }
            });
        });
    </script>
@stop