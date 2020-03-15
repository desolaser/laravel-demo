@extends('admin.layout')

@section('content')
    <input type="hidden" name="cotizacion_id" id="cotizacion_id" value="{{ $id }}">
    <input type="hidden" name="status" id="status" value="{{ $status }}">
    <div class="box">
        @if ($status == "OPERACIONES")
      	   <a class="btn btn-sm btn-primary" id="add" data-toggle="modal" data-target="#modal-creacion">Agregar nuevo trabajo</a>
        @endif
        <a class="btn btn-sm btn-primary" href="{{ url("/pdf/workReport/{$id}") }}">Excel</a>
        <div id="works">
        </div>
    </div>

    <!-- Modal de Creacióc -->
    <div class="modal fade" id="modal-creacion">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Creación de trabajo</h4>
                </div>
                <div id="create-work" class="modal-body">
                    <div class="box box-info">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nombre" class="col-sm-4 control-label">Intervención</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="motivo">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nombre" class="col-sm-4 control-label">OT</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="OT">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nombre" class="col-sm-4 control-label">GD</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="GD">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nombre" class="col-sm-4 control-label">Fecha ingreso</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" id="fecha_ingreso">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nombre" class="col-sm-4 control-label">Fecha retorno</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" id="fecha_retorno">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <a id="create" class="btn btn-primary pull-right">Guardar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Creación -->
    <div class="modal fade" id="modal-edicion">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Edición de trabajo</h4>
                </div>
                <div id="edit-work" class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <a id="update" class="btn btn-primary pull-right">Guardar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Trabajadores -->
    <div class="modal fade" id="modal-trabajadores">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Trabajadores</h4>
                </div>
                <div id="edit-workers" class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <a id="add_worker" class="btn btn-primary pull-right">Agregar trabajador</a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $(document).ready(function () {
            var cotizacion_id = $('#cotizacion_id').val();
            var token = '{{csrf_token()}}';
            var data = {cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/trabajos/getWorks') }}",
                data: data,
                success: function (html) {
                    $("#works").empty();
                    $("#works").html(html);
                }
            });
        });

        $(document).on('click', "[name='del']", function() {
            var id = $(this).data('id');
            var cotizacion_id = $('#cotizacion_id').val();
            var token = '{{csrf_token()}}';
            var data = {id: id, cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/trabajos/delete') }}",
                data: data,
                success: function (html) {
                    $("#works").empty();
                    $("#works").html(html);
                }
            });
        });

        $(document).on('click', "[name='edit']", function() {
            var id = $(this).data('id');
            var cotizacion_id = $('#cotizacion_id').val();
            var token = '{{csrf_token()}}';
            var data = {id: id, cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/trabajos/edit') }}",
                data: data,
                success: function (html) {
                    $("#edit-work").empty();
                    $("#edit-work").html(html);
                }
            });
        });

        $(document).on('click', "[name='trabajadores']", function() {
            var id = $(this).data('id');
            var cotizacion_id = $('#cotizacion_id').val();
            var token = '{{ csrf_token() }}';
            var data = {id: id, cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/trabajos/workers') }}",
                data: data,
                success: function (html) {
                    $("#edit-workers").empty();
                    $("#edit-workers").html(html);
                }
            });
        });

        $(document).on('click', "[name='del_worker']", function() {
            var id = $('#edicion_trabajadores_id').val();
            var trabajador_id = $(this).data('id');
            var token = '{{ csrf_token() }}';
            var data = {id: id, trabajador_id: trabajador_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/trabajos/deleteWorker') }}",
                data: data,
                success: function (html) {
                    $("#edit-workers").empty();
                    $("#edit-workers").html(html);
                }
            });

            var cotizacion_id = $('#cotizacion_id').val();
            var token = '{{csrf_token()}}';
            var data = {cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/trabajos/getWorks') }}",
                data: data,
                success: function (html) {
                    $("#works").empty();
                    $("#works").html(html);
                }
            });
        });

        $("#create").click(function() {
            var cotizacion_id = $('#cotizacion_id').val();
            var motivo = $('#motivo').val();
            var OT = $('#OT').val();
            var GD = $('#GD').val();
            var fecha_ingreso = $('#fecha_ingreso').val();
            var fecha_retorno = $('#fecha_retorno').val();
            var token = '{{csrf_token()}}';
            var data = {
                cotizacion_id: cotizacion_id,
                motivo: motivo,
                OT: OT,
                GD: GD,
                fecha_ingreso: fecha_ingreso,
                fecha_retorno: fecha_retorno,
                _token: token
            };
            $.ajax({
                type: "POST",
                url: "{{ url('/trabajos/store') }}",
                data: data,
                success: function (html) {
                    alert("El trabajo ha sido creado exitosamente");
                    $("#works").empty();
                    $("#works").html(html);
                }
            });
        });

        $("#update").click(function() {
            var cotizacion_id = $('#cotizacion_id').val();
            var id = $('#trabajo_id').val();
            var motivo = $('#edit_motivo').val();
            var OT = $('#edit_OT').val();
            var GD = $('#edit_GD').val();
            var fecha_ingreso = $('#edit_fecha_ingreso').val();
            var fecha_retorno = $('#edit_fecha_retorno').val();
            var token = '{{csrf_token()}}';
            var data = {
                cotizacion_id: cotizacion_id,
                id: id,
                motivo: motivo,
                OT: OT,
                GD: GD,
                fecha_ingreso: fecha_ingreso,
                fecha_retorno: fecha_retorno,
                _token: token
            };
            $.ajax({
                type: "POST",
                url: "{{ url('/trabajos/update') }}",
                data: data,
                success: function (html) {
                    alert("El trabajo con id " + id + " ha sido actualizado");
                    $("#works").empty();
                    $("#works").html(html);
                }
            });
        });

        $("#add_worker").click(function() {
            var id = $('#edicion_trabajadores_id').val();
            var trabajador_id = $('#trabajador_id').val();
            var token = '{{csrf_token()}}';
            var data = {
                id: id,
                trabajador_id: trabajador_id,
                _token: token
            };
            $.ajax({
                type: "POST",
                url: "{{ url('/trabajos/addWorker') }}",
                data: data,
                success: function (html) {
                    alert("El trabajador ha sido agregado exitosamente");
                    $("#edit-workers").empty();
                    $("#edit-workers").html(html);
                }
            });

            var cotizacion_id = $('#cotizacion_id').val();
            var token = '{{csrf_token()}}';
            var data = {cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/trabajos/getWorks') }}",
                data: data,
                success: function (html) {
                    $("#works").empty();
                    $("#works").html(html);
                }
            });
        });
    </script>
@stop
