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
		<form class="form-horizontal" action="{{ url('notas/') }}" method="POST">
			@csrf
			<div class="box-body">
				<div class="form-group">
					<label for="detalle" class="col-sm-1 control-label">Detalle</label>

					<div class="col-sm-11">
						<textarea name="detalle" class="form-control" rows="6" required></textarea>
					</div>
				</div>
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<a href="{{ url('/notas') }}" class="btn btn-default">Cancelar</a>
				<button type="submit" class="btn btn-primary pull-right">Grabar</button>
			</div>
			<!-- /.box-footer -->
		</form>
	</div>
	<!-- /.box -->
@stop

@section('script')

@stop