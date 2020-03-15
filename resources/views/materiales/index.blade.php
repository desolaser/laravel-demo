@extends('admin.layout')

@section('content')
    <input type="hidden" name="cotizacion_id" id="cotizacion_id" value="{{ $id }}">
    <input type="hidden" name="status" id="status" value="{{ $status }}">
    <div class="box">
        @if ($status == "OPERACIONES")
		        <a class="btn btn-sm btn-primary" id="add" data-toggle="modal" data-target="#modal-creacion">Agregar nuevo registro</a>
        @endif
        <div id="materiales">
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
                    <h4 class="modal-title">Creación de materiales</h4>
                </div>
                <div id="create-work" class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="producto" class="col-sm-4 control-label">Producto</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="producto">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cantidad" class="col-sm-4 control-label">Cantidad</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="cantidad">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="proveedor" class="col-sm-4 control-label">Proveedor</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="proveedor">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="p_proveedor" class="col-sm-4 control-label">Precio Proveedor</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="p_proveedor">
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

    <!-- Modal de Edición -->
    <div class="modal fade" id="modal-edicion">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Edición de materiales</h4>
                </div>
                <div id="edit-material" class="modal-body">
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
        $(document).ready(function () {
            var cotizacion_id = $('#cotizacion_id').val();
            var token = '{{csrf_token()}}';
            var data = {cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/materiales/show') }}",
                data: data,
                success: function (html) {
                    $("#materiales").empty();
                    $("#materiales").html(html);
                }
            });
        });

        $(document).on('click', "[name='del']", function() {
            var status = $("#status").val();
            if (status == "OPERACIONES") {
                var id = $(this).data('id');
                var cotizacion_id = $('#cotizacion_id').val();
                var token = '{{csrf_token()}}';
                var data = {id: id, cotizacion_id: cotizacion_id, _token: token};
                $.ajax({
                    type: "POST",
                    url: "{{ url('/materiales/delete') }}",
                    data: data,
                    success: function (html) {
                        $("#materiales").empty();
                        $("#materiales").html(html);
                        alert("Material eliminado exitosamente");
                    }
                });
            } else {
                alert("Ya no se pueden editar los datos de materiales");
            }
        });

        $(document).on('click', "[name='edit']", function() {
            var id = $(this).data('id');
            var cotizacion_id = $('#cotizacion_id').val();
            var token = '{{csrf_token()}}';
            var data = {id: id, cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/materiales/edit') }}",
                data: data,
                success: function (html) {
                    $("#edit-material").empty();
                    $("#edit-material").html(html);
                }
            });
        });

        $("#create").click(function (e) {
            e.preventDefault();

            var cotizacion_id = $('#cotizacion_id').val();
            var producto = $('#producto').val();
            var cantidad = $('#cantidad').val();
            var proveedor = $('#proveedor').val();
            var p_proveedor = $('#p_proveedor').val();
            var token = '{{csrf_token()}}';
            var data = {
                cotizacion_id: cotizacion_id,
                producto: producto,
                cantidad: cantidad,
                proveedor: proveedor,
                p_proveedor: p_proveedor,
                _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/materiales/store') }}",
                data: data,
                success: function (html) {
                    $("#materiales").empty();
                    $("#materiales").html(html);
                    alert("Material creado exitosamente");
                }
            });
        });

        $("#update").click(function(e) {
            e.preventDefault();

            var id = $('#material_id').val();
            var cotizacion_id = $('#cotizacion_id').val();
            var producto = $('#edit-producto').val();
            var cantidad = $('#edit-cantidad').val();
            var proveedor = $('#edit-proveedor').val();
            var p_proveedor = $('#edit-p_proveedor').val();
            var token = '{{csrf_token()}}';
            var data = {
                id: id,
                cotizacion_id: cotizacion_id,
                producto: producto,
                cantidad: cantidad,
                proveedor: proveedor,
                p_proveedor: p_proveedor,
                _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/materiales/update') }}",
                data: data,
                success: function (html) {
                    $("#materiales").empty();
                    $("#materiales").html(html);
                    alert("Material editado exitosamente");
                }
            });

        });
    </script>
@stop
