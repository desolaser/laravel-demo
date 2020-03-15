@extends('admin.layout')

@section('content')
<!--/.col (left) -->
<!-- right column -->
<div class="col-md-10">
	<!-- Horizontal Form -->
	<div class="box box-info">
		<!-- /.box-header -->
		<!-- form start -->
		@include('shared._errors')
		<form class="form-horizontal" action="{{ url("trabajadores/{$trabajador->id}") }}" method="POST">
			@csrf
			@method('PUT')
			<div class="box-body">
				<div class="form-group">
				<label for="nombre" class="col-sm-1 control-label">Nombre</label>
				<div class="col-sm-6">
					<input type="text"class="form-control" name="nombre" id="nombre" value="{{ old('nombre', $trabajador->nombre) }}" required>
				</div>

				<label for="rut" class="col-sm-1 control-label">RUT</label>
					<div class="col-sm-3">
					<input type="text" class="form-control" name="rut" id="rut" value="{{ old('nombre', $trabajador->rut) }}" required>
				</div>

					
				</div>
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<a href="{{ route('trabajadores.index') }}" class="btn btn-default">Cancelar</a>
				<button type="submit" class="btn btn-primary pull-right">Actualizar</button>
			</div>
			<!-- /.box-footer -->
		</form>
	</div>
	<!-- /.box -->
@stop

@section('script')

@stop