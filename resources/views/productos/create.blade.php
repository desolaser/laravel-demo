@extends('admin.layout')

@section('content')
	<div class="col-md-10">
		<div class="box box-info">

			@include('shared._errors')

			<form action="{{ url('productos') }}" method="POST" class="form-horizontal">
				@csrf
				<div class="box-body">
					<div class="form-group">
						<label for="nombre" class="col-sm-2 control-label">Servicio</label>

						<div class="col-sm-10">
							<select name="servicio_id" id="servicio_id" class="form-control">
						        <option value="">Seleccione un Servicio</option>
						        @foreach($servicios as $servicio)
						        	<option value="{{ $servicio->id }}" {{ old('servicio_id') == $servicio->id ? 'selected' : '' }}>
						                {{ $servicio->nombre }}
						            </option>
						        @endforeach
						    </select>
						</div>
					</div>

					<div class="form-group">
						<label for="categoria" class="col-sm-2 control-label">Categoria</label>

						<div class="col-sm-10">
							<select name="categoria_id" id="categoria_id" class="form-control">
						        <option value="" required>Seleccione una Categoría</option>
						        @foreach($categorias as $categoria)
						        	<option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : ''}}>
						                {{ $categoria->nombre }}
						            </option>
						        @endforeach
						    </select>
						</div>
					</div>

					<div class="form-group">
						<label for="producto" class="col-sm-2 control-label">Producto</label>

						<div class="col-sm-10">
							<textarea class="form-control" rows="4" placeholder="producto" name="nombre"  id=" nombre" required>{{ old('nombre') }}</textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="unidad" class="col-sm-2 control-label">Unidad</label>

						<div class="col-sm-10">
							<select name="unidad" id="unidad" class="form-control">
								<option value="">Seleccione la Unidad</option>
								<option value="MONTO" {{ old('unidad') == 'MONTO' ? 'selected' : '' }}>MONTO</option>
								<option value="METROS" {{ old('unidad') == 'METROS' ? 'selected' : '' }}>METROS</option>
								<option value="UNIDAD" {{ old('unidad') == 'UNIDAD' ? 'selected' : '' }}>UNIDAD</option>
							</select>
						</div>
					</div>


					<div class="form-group">
						<label for="precio" class="col-sm-2 control-label">Precio</label>

						<div class="col-sm-10">
							<input type="text" class="form-control" id="precio" name="precio" value="{{ old('precio') }}" required>
						</div>
					</div>

					<div class="box-footer">
						<a href="{{ route('productos.index')}}" class="btn btn-default">Cancelar</a>
						<button type="submit" class="btn btn-primary pull-right">Grabar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@stop
