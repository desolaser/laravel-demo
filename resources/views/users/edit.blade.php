@extends('admin.layout')

@section('content')
	<div class="col-md-10">
		<div class="box box-info">

			@include('shared._errors')

			<form action="{{ url("users/{$data->id}") }}" method="POST" class="form-horizontal">
				@csrf
                @method('PUT')
				<div class="box-body">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Nombre</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}">
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="email" name="email" value="{{ $data->email }}">
						</div>
					</div>
                    <div class="form-group">
						<label for="categoria" class="col-sm-2 control-label">Cargo</label>
						<div class="col-sm-10">
                            <select class="form-control" id="role" name="role">
								<option value="">Seleccione el Rol</option>
                                <option value="OPERARIO" {{ old('role', $data->role == 'OPERARIO') ? 'selected' : ''}}>Operario</option>
                                <option value="SUPERVISOR" {{ old('role', $data->role == 'SUPERVISOR') ? 'selected' : ''}}>Supervisor</option>
                                <option value="SUPERUSUARIO" {{ old('role', $data->role == 'SUPERUSUARIO') ? 'selected' : ''}}>Super Usuario</option>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label for="password" class="col-sm-2 control-label">Contraseña</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="password" name="password" value="{{ $data->password }}">
						</div>
					</div>
					<div class="box-footer">
						<a href="{{ route('users.index') }}" class="btn btn-default">Cancelar</a>
						<button type="submit" class="btn btn-primary pull-right">Actualizar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@stop
