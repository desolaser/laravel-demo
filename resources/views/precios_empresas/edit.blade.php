@extends('admin.layout')

@section('content')
	<div class="col-md-10">
		<div class="box box-info">

			@include('shared._errors')

			<form action="{{ url("precios/{$data->id}") }}" method="POST" class="form-horizontal">
				@csrf
                @method('PUT')
				<div class="box-body">
					<div class="form-group">
						<label for="nombre" class="col-sm-2 control-label">Servicio</label>

						<div class="col-sm-10">
							<input type="text" class="form-control" id="nombre" value="{{ $data->servicio->nombre }}" readonly>
						</div>
					</div>

					<div class="form-group">
						<label for="categoria" class="col-sm-2 control-label">Categoria</label>

						<div class="col-sm-10">
							<input type="text" class="form-control" id="categoria" value="{{ $data->producto->categoria->nombre }}" readonly>
						</div>
					</div>

					<div class="form-group">
						<label for="producto" class="col-sm-2 control-label">Producto</label>

						<div class="col-sm-10">
							<textarea class="form-control" rows="4" placeholder="producto" disabled>{{ $data->producto->nombre }}</textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="precioBase" class="col-sm-2 control-label">Precio Base</label>

						<div class="col-sm-10">
							<input type="text" class="form-control" id="precioBase" value="{{ $data->producto->precio }}" readonly>
						</div>
					</div>

					<div class="form-group">
						<label for="unidad" class="col-sm-2 control-label">Unidad</label>

						<div class="col-sm-10">
							<input type="text" class="form-control" id="unidad" value="{{ $data->producto->unidad }}" readonly>
						</div>
					</div>


					<div class="form-group">
						<label for="precio" class="col-sm-2 control-label">Precio</label>

						<div class="col-sm-10">
							<input type="text" class="form-control" id="precio" name="precio" value="{{ old('precio', $data->precio) }}">
						</div>
					</div>

					<div class="box-footer">
						<a href="{{ route('precios.index')}}" class="btn btn-default">Cancelar</a>
						<button type="submit" class="btn btn-primary pull-right">Actualizar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@stop
