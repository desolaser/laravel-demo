@extends('admin.layout')

@section('content')
	<div class="col-md-10">
		<div class="box box-info">

			@include('shared._errors')

			<form action="{{ url('centros') }}" method="POST" class="form-horizontal">
				@csrf
				<div class="box-body">
					<div class="form-group">
						<label for="nombre" class="col-sm-2 control-label">Empresa</label>
						<div class="col-sm-10">
							<select name="empresa_id" id="empresa_id" class="form-control">
						        <option value="">Seleccione una empresa</option>
						        @foreach($empresas as $empresa)
						        	<option value="{{ $empresa->id }}" {{ old('empresa_id') == $empresa->id ? 'selected' : '' }}>
						                {{ $empresa->nombre }}
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
						<label for="zona" class="col-sm-2 control-label">Zona</label>
						<div class="col-sm-10">
							<input type="number" class="form-control" id="zona" name="zona" value="{{ old('zona') }}" required>
						</div>
					</div>
					<div class="box-footer">
						<a href="{{ route('centros.index')}}" class="btn btn-default">Cancelar</a>
						<button type="submit" class="btn btn-primary pull-right">Grabar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@stop
