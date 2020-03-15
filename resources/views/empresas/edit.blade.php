@extends('admin.layout')

@section('content')
	<div class="col-md-10">
		<div class="box box-info">

			@include('shared._errors')

			<form action="{{ url("empresas/{$data->id}") }}" method="POST" class="form-horizontal">
				@csrf
                @method('PUT')
				<div class="box-body">
					<div class="form-group">
						<label for="nombre" class="col-sm-2 control-label">Nombre</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="nombre" name="nombre" value="{{ $data->nombre }}">
						</div>
					</div>
					<div class="form-group">
						<label for="iniciales" class="col-sm-2 control-label">Iniciales</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="iniciales" name="iniciales" value="{{ $data->iniciales }}">
						</div>
					</div>
					<div class="form-group">
						<label for="giro" class="col-sm-2 control-label">Giro</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="giro" name="giro" value="{{ $data->giro }}">
						</div>
					</div>
					<div class="form-group">
						<label for="rut" class="col-sm-2 control-label">Rut</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="rut" name="rut" value="{{ $data->rut }}">
						</div>
					</div>
					<div class="form-group">
						<label for="razon_social" class="col-sm-2 control-label">Razon Social</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="razon_social" name="razon_social" value="{{ $data->razon_social }}">
						</div>
					</div>
					<div class="form-group">
						<label for="direccion" class="col-sm-2 control-label">Dirección</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="direccion" name="direccion" value="{{ $data->direccion }}">
						</div>
					</div>
					<div class="form-group">
						<label for="comuna" class="col-sm-2 control-label">Comuna</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="comuna" name="comuna" value="{{ $data->comuna }}">
						</div>
					</div>
					<div class="form-group">
						<label for="ciudad" class="col-sm-2 control-label">Ciudad</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="ciudad" name="ciudad" value="{{ $data->ciudad }}">
						</div>
					</div>
					<div class="form-group">
						<label for="contacto" class="col-sm-2 control-label">Contacto</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="contacto" name="contacto" value="{{ $data->contacto }}">
						</div>
					</div>

					<div class="box-footer">
						<a href="{{ route('empresas.index') }}" class="btn btn-default">Cancelar</a>
						<button type="submit" class="btn btn-primary pull-right">Actualizar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@stop
