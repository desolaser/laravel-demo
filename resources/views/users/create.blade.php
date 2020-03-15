@extends('admin.layout')

@section('content')
	<div class="col-md-10">
		<div class="box box-info">

			@include('shared._errors')

			<form action="{{ url('users') }}" method="POST" class="form-horizontal">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
						<label for="categoria" class="col-sm-2 control-label">Rol</label>
						<div class="col-sm-10">
                            <select class="form-control" id="role" name="role">
                                <option value="" required>Seleccione un Rol</option>
                                <option value="DIGITADOR_CIG">Digitador CIG</option>
                                <option value="DIGITADOR_CIM">Digitador CIM</option>
                                <option value="DIGITADOR_IM">Digitador IM</option>
                                <option value="DIGITADOR_DT">Digitador DT</option>
                                <option value="SUPERVISOR">Supervisor</option>
                                <option value="SUPERUSUARIO">Super Usuario</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">Nueva Contraseña</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('users.index') }}" class="btn btn-default">Cancelar</a>
                        <button type="submit" class="btn btn-primary pull-right">Grabar</button>
                    </div>
            </form>
    </div>
</div>
@stop