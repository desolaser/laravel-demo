@extends('admin.layout')

@section('content')
	<div class="col-md-12">
		<div class="box box-info">

  			@include('shared._errors')

        <div class="panel panel-primary col-md-2" style="padding: 20px; margin: 10px;">
            <img src="{{ asset('dist/img/avatar6.png') }}" class="user-image" alt="User Image">
            <div class="card-body">
                <h5 class="card-title">{{ $data->name }}</h5>
                <p class="card-text">{{ $data->role }}</p>
            </div>
        </div>

        <div class="panel panel-primary col-sm-9">
            <h2 style="padding-bottom: 10px">Opciones del perfil</h2>
            <form action="{{ url("users/update_profile/{$data->id}") }}" method="POST" class="form-horizontal">
								@csrf
			          @method('PUT')
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Nombre usuario</label>
                    <div class="col-sm-10">
                      <input type="name" class="form-control" id="name" name="name" value={{ $data->name }}>
                    </div>
                </div>
                  <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="email" name="email" value={{ $data->email }}>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Contraseña</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="password" name="password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="verify_password" class="col-sm-2 col-form-label">Verificar contraseña</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="verify_password" name="verify_password">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
