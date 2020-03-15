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
		<form class="form-horizontal" action="{{ url('trabajadores/') }}" method="POST">
			@csrf
			<div class="box-body">
				<div class="form-group">
					<label for="nombre" class="col-sm-1 control-label">Nombre</label>
					<div class="col-sm-6">
						<textarea name="nombre" class="form-control" rows="1" required></textarea>
					</div>
					<label for="rut" class="col-sm-1 control-label">RUT</label>
					<div class="col-sm-3">
						<textarea name="rut" class="form-control" rows="1" required></textarea>
					</div>
				</div>
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<a href="{{ url('/trabajadores') }}" class="btn btn-default">Cancelar</a>
				<button type="submit" class="btn btn-primary pull-right">Grabar</button>
			</div>
			<!-- /.box-footer -->
		</form>
	</div>
	<!-- /.box -->
@stop

@section('script')

@stop