@extends('admin.layout')

@section('content')
    <input type="hidden" name="cotizacion_id" id="cotizacion_id" value="{{ $id }}">
    <div class="box">
        @if ($status == "OPERACIONES")
		        <a class="btn btn-sm btn-primary" id="add" data-toggle="modal" data-target="#modal-creacion">Agregar nuevo registro</a>
        @endif
        <a class="btn btn-sm btn-primary" href="{{ url("/pdf/costReport/{$id}") }}">Excel</a>
        <div id="costs">
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
                    <h4 class="modal-title">Creación de gasto</h4>
                </div>
                <div id="create-work" class="modal-body">
                    <div class="box box-info">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nombre" class="col-sm-4 control-label">Nombre</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nombre">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nombre" class="col-sm-4 control-label">Gasto</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="gasto">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nombre" class="col-sm-4 control-label">Número boleta</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="numero_boleta">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nombre" class="col-sm-4 control-label">Fecha</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" id="fecha">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tipo" class="col-sm-4 control-label">Tipo</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="tipo" id="tipo">
                                        <option value="">Seleccione Tipo</option>
                                        <option value="Hotelería">Hotelería</option>
                                        <option value="Alimentación">Alimentación</option>
                                        <option value="Pasajes">Pasajes</option>
                                        <option value="Combustible">Combustible</option>
                                        <option value="Otros">Otros</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="trabajo_id" class="col-sm-4 control-label">Intervención</label>
                                <div class="col-sm-8">
                                    <select class="form-control col-sm-8" name="trabajo_id" id="trabajo_id">
                                        <option value="">Seleccione Intervención</option>
                                        @foreach($trabajos as $trabajo)
                                            <option value="{{ $trabajo->id }}">{{ $trabajo->motivo }}</option>
                                        @endforeach
                                    </select>
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
                    <h4 class="modal-title">Edición de gasto</h4>
                </div>
                <div id="edit-cost" class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <a id="update" class="btn btn-primary pull-right">Guardar</a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        function cargar_datos() {
            var cotizacion_id = $('#cotizacion_id').val();
            var token = '{{csrf_token()}}';
            var data = {cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/gastos/show') }}",
                data: data,
                success: function (html) {
                    $("#costs").empty();
                    $("#costs").html(html);
                }
            });
        }

        $("#trabajo_id").change(function (e) {
            e.preventDefault();
            cargar_datos();
        });

        $(document).ready(function () {
            cargar_datos();
        });

        $(document).on('click', "[name='del']", function() {
            var id = $(this).data('id');
            var trabajo_id = $('#trabajo_id').val();
            var cotizacion_id = $('#cotizacion_id').val();
            var token = '{{csrf_token()}}';
            var data = {
                id: id,
                trabajo_id: trabajo_id,
                cotizacion_id: cotizacion_id,
                _token: token,
            };
            $.ajax({
                type: "POST",
                url: "{{ url('/gastos/delete') }}",
                data: data,
                success: function (html) {
                    $("#costs").empty();
                    $("#costs").html(html);
                }
            });
        });

        $(document).on('click', "[name='edit']", function() {
            var id = $(this).data('id');
            var trabajo_id = $('#trabajo_id').val();
            var token = '{{csrf_token()}}';
            var data = {id: id, trabajo_id: trabajo_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/gastos/edit') }}",
                data: data,
                success: function (html) {
                    $("#edit-cost").empty();
                    $("#edit-cost").html(html);
                }
            });
        });

        $("#create").click(function() {
            var trabajo_id = $('#trabajo_id').val();
            var cotizacion_id = $('#cotizacion_id').val();
            var nombre = $('#nombre').val();
            var gasto = $('#gasto').val();
            var numero_boleta = $('#numero_boleta').val();
            var tipo = $('#tipo').val();
            var fecha = $('#fecha').val();
            var token = '{{csrf_token()}}';
            var data = {
                trabajo_id: trabajo_id,
                cotizacion_id: cotizacion_id,
                nombre: nombre,
                gasto: gasto,
                numero_boleta: numero_boleta,
                tipo: tipo,
                fecha: fecha,
                _token: token
            };
            $.ajax({
                type: "POST",
                url: "{{ url('/gastos/store') }}",
                data: data,
                success: function (html) {
                    alert("El gasto ha sido creado exitosamente");
                    $("#costs").empty();
                    $("#costs").html(html);
                }
            });
        });

        $("#update").click(function() {
            var trabajo_id = $('#trabajo_id').val();
            var cotizacion_id = $('#cotizacion_id').val();
            var id = $('#gasto_id').val();
            var nombre = $('#edit_nombre').val();
            var gasto = $('#edit_gasto').val();
            var numero_boleta = $('#edit_numero_boleta').val();
            var tipo = $('#edit_tipo').val();
            var fecha = $('#edit_fecha').val();
            var token = '{{csrf_token()}}';
            var data = {
                trabajo_id: trabajo_id,
                cotizacion_id: cotizacion_id,
                id: id,
                nombre: nombre,
                gasto: gasto,
                numero_boleta: numero_boleta,
                tipo: tipo,
                fecha: fecha,
                _token: token
            };
            $.ajax({
                type: "POST",
                url: "{{ url('/gastos/update') }}",
                data: data,
                success: function (html) {
                    alert("El gasto con id " + id + " ha sido actualizado");
                    $("#costs").empty();
                    $("#costs").html(html);
                }
            });
        });
    </script>
@stop
