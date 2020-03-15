@extends('admin.layout')

@section('content')
	<div class="col-md-10">
		<div class="box box-info">

			@include('shared._errors')

			<form action="{{ url('contactos') }}" method="POST" class="form-horizontal">
				@csrf
				<div class="box-body">
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
						<label for="nombre" class="col-sm-2 control-label">Nombre</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
						</div>
					</div>
					<div class="form-group">
						<label for="cargo" class="col-sm-2 control-label">Cargo</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="cargo" name="cargo" value="{{ old('cargo') }}" required>
						</div>
					</div>
					<div class="form-group">
						<label for="zona" class="col-sm-2 control-label">Zona</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="zona" name="zona" value="{{ old('zona') }}" required>
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
						</div>
					</div>
					<div class="form-group">
						<label for="movil" class="col-sm-2 control-label">Móvil</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="movil" name="movil" value="{{ old('movil') }}" required>
						</div>
					</div>
					<div class="form-group">
						<label for="oficina" class="col-sm-2 control-label">Oficina</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="oficina" name="oficina" value="{{ old('oficina') }}" required>
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
