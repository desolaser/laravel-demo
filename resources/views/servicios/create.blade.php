@extends('admin.layout')

@section('content')
	<div class="col-md-10">
		<div class="box box-info">

			@include('shared._errors')

			<form action="{{ url('servicios') }}" method="POST" class="form-horizontal">
				@csrf
				<div class="box-body">
					<div class="form-group">
						<label for="nombre" class="col-sm-2 control-label">Nombre</label>

						<div class="col-sm-10">
							<input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
						</div>
					</div>

					<div class="box-footer">
						<a href="{{ route('servicios.index')}}" class="btn btn-default">Cancelar</a>
						<button type="submit" class="btn btn-primary pull-right">Grabar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@stop
