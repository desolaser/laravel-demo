@extends('admin.layout')

@section('content')
    <div class="col-12">
        @include('shared._errors')

        <form action='{{ url("cotizaciones/{$cotizacion->id}") }}' method="POST" class="form-horizontal" id="formulario">
            @csrf
            @method('PUT')
            <input type="hidden" name="cotizacion_id" id="cotizacion_id" value="{{ $cotizacion->id }}">
            <input type="hidden" name="id_unique" id="id_unique" value="{{ $id_unique }}">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="nombre" class="col-sm-2 control-label">Empresa</label>
                        <div class="col-sm-10">
                            <select name="empresa_id" id="empresa_id" class="form-control">
                                <option value="">Seleccione empresa</option>
                                @foreach($empresas as $items)
                                <option value="{{ $items->id }}">{{ $items->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nombre" class="col-sm-2 control-label">Contacto</label>

                        <div class="col-sm-10">
                            <select name="contacto_id" id="contacto_id" class="form-control">
                                <option value="">Seleccione contacto</option>
                            </select>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-productos">
                            <i class="fa fa-search"></i> Productos</a>
                        </button>

                        <button type="button" class="btn btn-primary btn-sm" id="recalcular">
                            <i class="fa fa-money"></i> Recalcular</a>
                        </button>

                        <a href="" class="btn btn-default btn-sm pull-right">Cancelar</a>
                        <button type="submit" class="btn btn-primary btn-sm pull-right">
                            <i class="fa fa-save"></i>
                        </button>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="nombre" class="col-sm-2 control-label">Notas</label>
                        <div class="col-sm-10">
                            <select name="" id="nota-default" class="form-control">
                                <option value="">Seleccione Nota</option>
                                @foreach($notas as $nota)
                                    <option value="{{ $nota->detalle }}">{{ $nota->detalle }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nombre" class="col-sm-2 control-label">Nota</label>
                        <div class="col-sm-10">
                            <textarea name="nota" id="nota" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nombre" class="col-sm-2 control-label">Gastos asociados a viajes y otros</label>
                        <div class="col-sm-10">
                            <input type="text" name="viatico" id="viatico" class="form-control" value="0" pattern="[0-9]+">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nombre" class="col-sm-2 control-label">Descuento</label>
                        <div class="col-sm-10">
                            <input type="text" name="descuento" id="descuento" class="form-control" value="0" pattern="[0-9]+">
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive" id="detalle">
                <table class="table table-striped table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th width="30px">#</th>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Total</th>
                            <th class="text-center">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </form>
    </div>

    <!-- Modal de Productos -->
    <div class="modal fade" id="modal-productos">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Productos</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <select name="servicio_id" id="servicio_id" class="form-control" required>
                                    <option value="">Seleccione servicio</option>
                                        @foreach($servicios as $item)
                                            <option value="{{ $item->id}}">{{ $item->nombre}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="div_productos">
                        <table class="table table-striped table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="30px">#</th>
                                    <th>Nombre</th>
                                    <th>Unidad</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th class="text-center">
                                        <i class="fa fa-plus"></i>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Viaticos -->
    <div class="modal fade" id="modal-viactos">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Gastos asociados a viajes y otros</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <label for="viatico" class="col-sm-2 control-label">Monto</label>
                            <div class="col-sm-10"></div>
                            <input type="text" class="form-control" id="monto" placeholder="Monto del Viático">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary pull-rigth procesar-ajax" data-dismiss="modal" id="procesar-viatico">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        function actualizar_contactos(async) {
            var empresa_id = $('#empresa_id').val();
            var token = '{{csrf_token()}}';
            var data = {empresa_id: empresa_id, _token: token};

            $.ajax({
                type: "post",
                url: "{{ url('cotizaciones/getContactos/') }}",
                data: data,
                async: async,
                success: function (data) {
                    $("#contacto_id").empty();
                    $("#contacto_id").append('<option value="">Seleccione contacto</option>');
                    $.each(data, function(i, item){
                        $("#contacto_id").append('<option value='+data[i].id+'>'+data[i].nombre+'</option>');
                    })
                }
            });
        }

        $(document).ready(function() {
            var cotizacion_id = $('#cotizacion_id').val();
            var token = '{{csrf_token()}}';
            var data = {cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "post",
                url: "{{ url('cotizaciones/getDetalleCotizacion/') }}",
                data: data,
                success: function (data) {
                    $("#empresa_id").val(data.empresa_id);
                    actualizar_contactos(false);
                    $("#contacto_id").val(data.contacto_id);
                    $("#nota").val(data.nota);
                    $("#viatico").val(data.viatico);
                    $("#descuento").val(data.descuento);

                    var id_unique =  $('#id_unique').val();
                    var viatico =  $('#viatico').val();
                    var descuento =  $('#descuento').val();
                    var token = '{{ csrf_token() }}';
                    var data = {
                        id_unique: id_unique,
                        cotizacion_id: cotizacion_id,
                        viatico: viatico,
                        descuento: descuento,
                        _token: token,
                        pagina: 'getProductosEdicionAnteriores'
                    };

                    $.ajax({
                        type: "POST",
                        url: "{{ url('cotizaciones/setProductos/') }}",
                        data: data,
                        success: function (html) {
                            $("#detalle").empty();
                            $("#detalle").html(html);
                        }
                    });
                }
            });
            actualizar_datos();
        });

        $("#empresa_id").change(function (e) {
            e.preventDefault();
            actualizar_contactos(true);
        });

        $("#nota-default").change(function () {
            var nota = $("#nota-default").val();
            $("#nota").empty();
            $("#nota").val(nota);
        });

        $("#modal-productos").on('change', "#servicio_id", function () {
            var empresa_id = $('#empresa_id').val();
            var servicio_id = $('#servicio_id').val();
            var token = '{{ csrf_token() }}';
            var data = {empresa_id: empresa_id, servicio_id: servicio_id,_token: token};

            $.ajax({
                type: "POST",
                url: "{{ url('cotizaciones/getProductos/') }}",
                data: data,
                success: function (data) {
                    $("#div_productos").empty();
                    $("#div_productos").html(data);
                }
            });
        });

        $("#recalcular").click(function() {
            var id_unique =  $('#id_unique').val();
            var viatico =  $('#viatico').val();
            var descuento =  $('#descuento').val();
            var token = '{{ csrf_token() }}';
            var data = {id_unique: id_unique, viatico: viatico, descuento: descuento, _token: token, pagina: 'index'};

            $.ajax({
                type: "POST",
                url: "{{ url('cotizaciones/setProductos/') }}",
                data: data,
                success: function (html) {
                    $("#detalle").empty();
                    $("#detalle").html(html);
                }
            });
        });

        $(document).on('click', "[name='del']", function() {
            var id = $(this).data('id');
            var det_cotizacion_id = $(this).data('det_cotizacion_id');
            var viatico =  $('#viatico').val();
            var descuento =  $('#descuento').val();
            var token = '{{ csrf_token() }}';
            var data = {
                id: id,
                det_cotizacion_id: det_cotizacion_id,
                viatico: viatico,
                descuento: descuento,
                _token: token,
                pagina: 'delRow'};

            $.ajax({
                type: "POST",
                url: "{{ url('cotizaciones/delRow') }}",
                data: data,
                success: function (html) {
                    $("#detalle").empty();
                    $("#detalle").html(html);
                }
            });
        });

        $("#cotizacion-anterior").change(function() {
            if($(this).prop('checked') == true) {
                $("#cotizacion_id").prop('disabled', false);
            }
            else {
                $("#cotizacion_id").prop('disabled', true);
            }
        });

			  $("#newFile").on("submit", function(e){
            e.preventDefault();

            var formData = new FormData(document.getElementById("newFile"));
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "{{ url('/operaciones/newFile') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#files").empty();
                    $("#files").html(data);
                    setTimeout(function(){
                        $("div.alert").fadeOut();
                    }, 5000 );
                }
            });
        });

        $("#newPost").on("submit", function(e){
            e.preventDefault();

            var formData = new FormData(document.getElementById("newPost"));
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "{{ url('/posts/store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#posts").empty();
                    $("#posts").html(data);
                    setTimeout(function(){
                        $("div.alert").fadeOut();
                    }, 5000 );
                }
            });
        });

        $(document).on('click', "[name='del_file']", function() {
            var id = $(this).data('id');
            var cotizacion_id = $('#cotizacion_id').val();
            var token = '{{csrf_token()}}';
            var data = {id: id, cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/operaciones/deleteFile') }}",
                data: data,
                success: function (data) {
                    $("#files").empty();
                    $("#files").html(data);
                    setTimeout(function(){
                        $("div.alert").fadeOut();
                    }, 5000 );
                }
            });
        });

        $(document).on('click', "[name='del_post']", function() {
            var id = $(this).data('id');
            var cotizacion_id = $('#cotizacion_id').val();
            var token = '{{csrf_token()}}';
            var data = {id: id, cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/posts/delete') }}",
                data: data,
                success: function (data) {
                    $("#posts").empty();
                    $("#posts").html(data);
                    setTimeout(function(){
                        $("div.alert").fadeOut();
                    }, 5000 );
                }
            });
        });
    </script>
@stop
