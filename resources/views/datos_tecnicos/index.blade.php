@extends('admin.layout')

@section('content')
    <input type="hidden" name="cotizacion_id" id="cotizacion_id" value="{{ $id }}">
    <div class="box">
        @if ($status == "OPERACIONES")
		        <a class="btn btn-sm btn-primary" id="add" data-toggle="modal" data-target="#modal-creacion">Agregar nuevo registro</a>
        @endif
        <div id="modulos">
            <div class="bg-success" style="padding: 20px" id="titulo_modulo">
            </div>
            <div id="dvr">
            </div>
            <div id="ap-modulo">
            </div>
            <div id="camaras">
            </div>
            <div id="broadcasts">
            </div>
        </div>
        <div id="ponton">
            <div class="bg-warning" style="padding: 20px" id="titulo_ponton">
            </div>
            <div id="computadores">
            </div>
            <div id="tvs">
            </div>
            <div id="cables">
            </div>
            <div id="reguladores">
            </div>
            <div id="ups">
            </div>
            <div id="switchs">
            </div>
            <div id="ap">
            </div>
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
                    <h4 class="modal-title">Ingreso del Equipo/s</h4>
                </div>
                <div id="create-work" class="modal-body">
                    <div class="box box-info">
                        <div class="box-body">
                            <div id="div-tipo-equipo" class="form-group col-md-12">
                                <label for="tipo-equipo">Tipo de Equipo</label>
                                <select id="tipo-equipo" class="form-control">
                                    <option value="0">Para Pontón</option>
                                    <option value="1">Para Módulo</option>
                                </select>
                            </div>
                            <div id="div-equipo-modulo"  class="form-group col-md-12">
                                <label for="equipo-modulo">Equipo Pontón</label>
                                <select id="equipo-modulo" class="form-control">
                                    <option value="COMPUTADOR">Computador</option>
                                    <option value="TV">TV</option>
                                    <option value="CABLE">Cable</option>
                                    <option value="REGULADOR">Regulador</option>
                                    <option value="UPS">UPS</option>
                                    <option value="SWITCH">Switch</option>
                                    <option value="AP">AP</option>
                                </select>
                            </div>
                            <div id="div-equipo-ponton" class="form-group col-md-12">
                                <label for="equipo-ponton">Equipo Módulo</label>
                                <select id="equipo-ponton" class="form-control">
                                    <option value="DVR">DVR</option>
                                    <option value="AP">AP</option>
                                    <option value="CAMARAS">Cámara</option>
                                    <option value="BROADCAST">Broadcast</option>
                                </select>
                            </div>
                            <!-- //////////// Pontón ////////////-->
                            <form class="form-group" enctype="multipart/form-data" id="new-computador" method="POST">
                                <h3>Computador</h3>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <label for="serial">Serial</label>
                                <input class="form-control" type="text" name="serial" id="serial" required>
                                <label for="modelo">Modelo</label>
                                <input class="form-control" type="text" name="modelo" id="modelo" required>
                                <label for="tipo">Tipo</label>
                                <input class="form-control" type="text" name="tipo" id="tipo" required>
                                <label for="placa_madre">Placa madre</label>
                                <input class="form-control" type="text" name="placa_madre" id="placa_madre" required>
                                <label for="fuente_poder">Fuente de poder</label>
                                <input class="form-control" type="text" name="fuente_poder" id="fuente_poder" required>
                                <label for="procesador">Procesador</label>
                                <input class="form-control" type="text" name="procesador" id="procesador" required>
                                <label for="teclado">Teclado</label>
                                <input class="form-control" type="text" name="teclado" id="teclado" required>
                                <label for="mouse">Mouse</label>
                                <input class="form-control" type="text" name="mouse" id="mouse" required>
                                <label for="ram">Memoria RAM</label>
                                <input class="form-control" type="text" name="ram" id="ram" required>
                                <label for="disco_duro">Disco duro</label>
                                <input class="form-control" type="text" name="disco_duro" id="disco_duro" required>
                                <label for="tarjeta_video">Tarjeta Gráfica</label>
                                <input class="form-control" type="text" name="tarjeta_video" id="tarjeta_video" required>
                                <label for="wifi">Tarjeta WiFi</label>
                                <input class="form-control" type="text" name="wifi" id="wifi" required>
                                <input class="btn btn-primary" style="margin-top: 20px" type="submit" value="Guardar">
                            </form>
                            <form class="form-group" enctype="multipart/form-data" id="new-tv" method="POST">
                                <h3>TV</h3>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <label for="marca">Serial</label>
                                <input class="form-control" type="text" name="serial" id="serial" required>
                                <label for="marca">Marca</label>
                                <input class="form-control" type="text" name="marca" id="marca" required>
                                <label for="modelo">Modelo</label>
                                <input class="form-control" type="text" name="modelo" id="modelo" required>
                                <label for="dimension">Dimensión</label>
                                <input class="form-control" type="text" name="dimension" id="dimension" required>
                                <label for="formato">Formato</label>
                                <input class="form-control" type="text" name="formato" id="formato" required>
                                <input class="btn btn-primary" style="margin-top: 20px" type="submit" value="Guardar">
                            </form>
                            <form class="form-group" enctype="multipart/form-data" id="new-cable" method="POST">
                                <h3>Cable</h3>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <label for="tipo_cable">Tipo cable</label>
                                <input class="form-control" type="text" name="tipo_cable" id="tipo_cable" required>
                                <label for="longitud">Longitud</label>
                                <input class="form-control" type="text" name="longitud" id="longitud" required>
                                <label for="cantidad">Cantidad</label>
                                <input class="form-control" type="number" name="cantidad" id="cantidad" required>
                                <input class="btn btn-primary" style="margin-top: 20px" type="submit" value="Guardar">
                            </form>
                            <form class="form-group" enctype="multipart/form-data" id="new-regulador" method="POST">
                                <h3>Regulador</h3>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <label for="marca">Serial</label>
                                <input class="form-control" type="text" name="serial" id="serial" required>
                                <label for="marca">Marca</label>
                                <input class="form-control" type="text" name="marca" id="marca" required>
                                <label for="modelo">Modelo</label>
                                <input class="form-control" type="text" name="modelo" id="modelo" required>
                                <input class="btn btn-primary" style="margin-top: 20px" type="submit" value="Guardar">
                            </form>
                            <form class="form-group" enctype="multipart/form-data" id="new-ups" method="POST">
                                <h3>UPS</h3>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <label for="marca">Serial</label>
                                <input class="form-control" type="text" name="serial" id="serial" required>
                                <label for="marca">Marca</label>
                                <input class="form-control" type="text" name="marca" id="marca" required>
                                <label for="modelo">Modelo</label>
                                <input class="form-control" type="text" name="modelo" id="modelo" required>
                                <input class="btn btn-primary" style="margin-top: 20px" type="submit" value="Guardar">
                            </form>
                            <form class="form-group" enctype="multipart/form-data" id="new-switch" method="POST">
                                <h3>Switch</h3>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <label for="marca">Serial</label>
                                <input class="form-control" type="text" name="serial" id="serial" required>
                                <label for="marca">Marca</label>
                                <input class="form-control" type="text" name="marca" id="marca" required>
                                <label for="modelo">Modelo</label>
                                <input class="form-control" type="text" name="modelo" id="modelo" required>
                                <input class="btn btn-primary" style="margin-top: 20px" type="submit" value="Guardar">
                            </form>
                            <form class="form-group" enctype="multipart/form-data" id="new-ap" method="POST">
                                <h3>AP</h3>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="tipo_equipo" value="PONTON">
                                <label for="marca">Serial</label>
                                <input class="form-control" type="text" name="serial" id="serial" required>
                                <label for="marca">Marca</label>
                                <input class="form-control" type="text" name="marca" id="marca" required>
                                <label for="modelo">Modelo</label>
                                <input class="form-control" type="text" name="modelo" id="modelo" required>
                                <label for="usuario">Usuario</label>
                                <input class="form-control" type="text" name="usuario" id="usuario" required>
                                <label for="clave">Clave</label>
                                <input class="form-control" type="text" name="clave" id="clave" required>
                                <label for="ssid">SSID</label>
                                <input class="form-control" type="text" name="ssid" id="ssid" required>
                                <label for="wifi">Wifi</label>
                                <input class="form-control" type="text" name="wifi" id="wifi" required>
                                <label for="ip">IP</label>
                                <input class="form-control" type="text" name="ip" id="ip" required>
                                <label for="firmware">Firmware</label>
                                <input class="form-control" type="text" name="firmware" id="firmware" required>
                                <label for="backup">Backup</label>
                                <input class="form-control" type="text" name="backup" id="backup" required>
                                <label for="tipo">Tipo</label>
                                <input class="form-control" type="text" name="tipo" id="tipo" required>
                                <input class="btn btn-primary" style="margin-top: 20px" type="submit" value="Guardar">
                            </form>
                            <!-- ///////////// Módulo ///////////// -->
                            <form class="form-group" enctype="multipart/form-data" id="new-dvr" method="POST">
                                <h3>DVR</h3>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <label for="serial">Serial</label>
                                <input class="form-control" type="text" name="serial" id="serial" required>
                                <label for="marca">Marca</label>
                                <input class="form-control" type="text" name="marca" id="marca" required>
                                <label for="modelo">Modelo</label>
                                <input class="form-control" type="text" name="modelo" id="modelo" required>
                                <input class="btn btn-primary" style="margin-top: 20px" type="submit" value="Guardar">
                            </form>
                            <form class="form-group" enctype="multipart/form-data" id="new-ap-modulo" method="POST">
                                <h3>AP</h3>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="tipo_equipo" value="MODULO">
                                <label for="marca">Serial</label>
                                <input class="form-control" type="text" name="serial" id="serial" required>
                                <label for="marca">Marca</label>
                                <input class="form-control" type="text" name="marca" id="marca" required>
                                <label for="modelo">Modelo</label>
                                <input class="form-control" type="text" name="modelo" id="modelo" required>
                                <label for="usuario">Usuario</label>
                                <input class="form-control" type="text" name="usuario" id="usuario" required>
                                <label for="clave">Clave</label>
                                <input class="form-control" type="text" name="clave" id="clave" required>
                                <label for="ssid">SSID</label>
                                <input class="form-control" type="text" name="ssid" id="ssid" required>
                                <label for="wifi">Wifi</label>
                                <input class="form-control" type="text" name="wifi" id="wifi" required>
                                <label for="ip">IP</label>
                                <input class="form-control" type="text" name="ip" id="ip" required>
                                <label for="firmware">Firmware</label>
                                <input class="form-control" type="text" name="firmware" id="firmware" required>
                                <label for="backup">Backup</label>
                                <input class="form-control" type="text" name="backup" id="backup" required>
                                <label for="tipo">Tipo</label>
                                <input class="form-control" type="text" name="tipo" id="tipo" required>
                                <input class="btn btn-primary" style="margin-top: 20px" type="submit" value="Guardar">
                            </form>
                            <form class="form-group" enctype="multipart/form-data" id="new-camara" method="POST">
                                <h3>Cámara</h3>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <label for="serial">Serial</label>
                                <input class="form-control" type="text" name="serial" id="serial" required>
                                <label for="marca">Marca</label>
                                <input class="form-control" type="text" name="marca" id="marca" required>
                                <label for="modelo">Modelo</label>
                                <input class="form-control" type="text" name="modelo" id="modelo" required>
                                <label for="usuario">Usuario</label>
                                <input class="form-control" type="text" name="usuario" id="usuario" required>
                                <label for="clave">Clave</label>
                                <input class="form-control" type="text" name="clave" id="clave" required>
                                <label for="serial_p2p">Serial P2P</label>
                                <input class="form-control" type="text" name="serial_p2p" id="serial_p2p" required>
                                <label for="ip">IP</label>
                                <input class="form-control" type="text" name="ip" id="ip" required>
                                <label for="mac_address">Mac address</label>
                                <input class="form-control" type="text" name="mac_address" id="mac_address" required>
                                <label for="nombre">Nombre</label>
                                <input class="form-control" type="text" name="nombre" id="nombre" required>
                                <label for="firmware">Firmware</label>
                                <input class="form-control" type="text" name="firmware" id="firmware" required>
                                <label for="backup">Backup</label>
                                <input class="form-control" type="text" name="backup" id="backup" required>
                                <input class="btn btn-primary" style="margin-top: 20px" type="submit" value="Guardar">
                            </form>
                            <form class="form-group" enctype="multipart/form-data" id="new-broadcast" method="POST">
                                <h3>Broadcast</h3>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <label for="serial">Serial</label>
                                <input class="form-control" type="text" name="serial" id="serial" required>
                                <label for="modelo">Modelo</label>
                                <input class="form-control" type="text" name="modelo" id="modelo" required>
                                <label for="usuario">Usuario</label>
                                <input class="form-control" type="text" name="usuario" id="usuario" required>
                                <label for="clave">Clave</label>
                                <input class="form-control" type="text" name="clave" id="clave" required>
                                <label for="serial_p2p">Serial P2P</label>
                                <input class="form-control" type="text" name="serial_p2p" id="serial_p2p" required>
                                <label for="ip">IP</label>
                                <input class="form-control" type="text" name="ip" id="ip" required>
                                <label for="mac_address">Mac address</label>
                                <input class="form-control" type="text" name="mac_address" id="mac_address" required>
                                <label for="nombre">Nombre</label>
                                <input class="form-control" type="text" name="nombre" id="nombre" required>
                                <label for="firmware">Firmware</label>
                                <input class="form-control" type="text" name="firmware" id="firmware" required>
                                <label for="backup">Backup</label>
                                <input class="form-control" type="text" name="backup" id="backup" required>
                                <label for="marca_dvr">Marca Dvr</label>
                                <input class="form-control" type="text" name="marca_dvr" id="marca_dvr" required>
                                <label for="modelo_dvr">Modelo Dvr</label>
                                <input class="form-control" type="text" name="modelo_dvr" id="modelo_dvr" required>
                                <label for="numero_produccion">Número producción</label>
                                <input class="form-control" type="number" name="numero_produccion" id="numero_produccion" required>
                                <label for="numero_camaras">Número cámaras</label>
                                <input class="form-control" type="number" name="numero_camaras" id="numero_camaras" required>
                                <input class="btn btn-primary" style="margin-top: 20px" type="submit" value="Guardar">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
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
                    <h4 id="edit-title" class="modal-title">Edición de datos técnicos</h4>
                </div>
                <div id="edit-data" class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        function isEmpty( el ){
            return !$.trim(el.html())
        }

        function updateModuloTitle() {
            if (isEmpty($('#dvr')) && isEmpty($('#ap-modulo')) && isEmpty($('#camaras')) && isEmpty($('#broadcasts'))) {
                $('#titulo_modulo').empty();
                $('#titulo_modulo').html("<h4>No hay equipos de módulo asociados a esta cotización</h4>");
            } else {
                $('#titulo_modulo').empty();
                $('#titulo_modulo').html("<h4>Equipos de módulo</h4>");
            }
        }

        function updatePontonTitle() {
            if (isEmpty($('#computadores')) && isEmpty($('#tvs')) && isEmpty($('#cables')) &&
                    isEmpty($('#ups')) && isEmpty($('#switchs')) && isEmpty($('#ap')) && isEmpty($('#reguladores'))) {
                $('#titulo_ponton').empty();
                $('#titulo_ponton').html("<h4>No hay equipos de pontón asociados a esta cotización</h4>");
            } else {
                $('#titulo_ponton').empty();
                $('#titulo_ponton').html("<h4>Equipos de pontón</h4>");
            }
        }

        $(document).ready(function () {
            $("#div-equipo-ponton").hide();

            $("#new-dvr").hide();
            $("#new-ap-modulo").hide();
            $("#new-camara").hide();
            $("#new-broadcast").hide();

            $("#new-computador").show();
            $("#new-tv").hide();
            $("#new-cable").hide();
            $("#new-regulador").hide();
            $("#new-ups").hide();
            $("#new-switch").hide();
            $("#new-ap").hide();


            var cotizacion_id = $('#cotizacion_id').val();

            /* ------------------------------------------------ */
            /* -------------------- MODULO -------------------- */
            /* ------------------------------------------------ */

            var token = '{{csrf_token()}}';
            var data = {cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/pc/show') }}",
                data: data,
                async: false,
                success: function (html) {
                    $("#computadores").empty();
                    $("#computadores").html(html);
                }
            });

            var token = '{{csrf_token()}}';
            var data = {cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/tv/show') }}",
                data: data,
                async: false,
                success: function (html) {
                    $("#tvs").empty();
                    $("#tvs").html(html);
                }
            });

            var token = '{{csrf_token()}}';
            var data = {cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/cable/show') }}",
                data: data,
                async: false,
                success: function (html) {
                    $("#cables").empty();
                    $("#cables").html(html);
                }
            });

            var token = '{{csrf_token()}}';
            var data = {cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/regulador/show') }}",
                data: data,
                async: false,
                success: function (html) {
                    $("#reguladores").empty();
                    $("#reguladores").html(html);
                }
            });

            var token = '{{csrf_token()}}';
            var data = {cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/ups/show') }}",
                data: data,
                async: false,
                success: function (html) {
                    $("#ups").empty();
                    $("#ups").html(html);
                }
            });

            var token = '{{csrf_token()}}';
            var data = {cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/switch/show') }}",
                data: data,
                async: false,
                success: function (html) {
                    $("#switchs").empty();
                    $("#switchs").html(html);
                }
            });

            var token = '{{csrf_token()}}';
            var data = {cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/ap/show') }}",
                data: data,
                async: false,
                success: function (html) {
                    $("#ap").empty();
                    $("#ap").html(html);
                }
            });

            /* ------------------------------------------------ */
            /* -------------------- PONTÓN -------------------- */
            /* ------------------------------------------------ */
            var token = '{{csrf_token()}}';
            var data = {cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/dvr/show') }}",
                data: data,
                async: false,
                success: function (html) {
                    $("#dvr").empty();
                    $("#dvr").html(html);
                }
            });

            var token = '{{csrf_token()}}';
            var data = {cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/ap/show_modulo') }}",
                data: data,
                async: false,
                success: function (html) {
                    $("#ap-modulo").empty();
                    $("#ap-modulo").html(html);
                }
            });

            var token = '{{csrf_token()}}';
            var data = {cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/camara/show') }}",
                data: data,
                async: false,
                success: function (html) {
                    $("#camaras").empty();
                    $("#camaras").html(html);
                }
            });

            var token = '{{csrf_token()}}';
            var data = {cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/broadcast/show') }}",
                data: data,
                async: false,
                success: function (html) {
                    $("#broadcasts").empty();
                    $("#broadcasts").html(html);
                }
            });

            updateModuloTitle();
            updatePontonTitle();
        });

        $("#tipo-equipo").change(function() {
            var value = $(this).val();
            if (value == 0) {
                $("#div-equipo-modulo").show();
                $("#div-equipo-ponton").hide();

                $("#equipo-modulo").val("COMPUTADOR");
                $("#new-computador").show();

                $("#new-dvr").hide();
                $("#new-ap-modulo").hide();
                $("#new-camara").hide();
                $("#new-broadcast").hide();
            }
            else {
                $("#div-equipo-modulo").hide();
                $("#div-equipo-ponton").show();

                $("#equipo-ponton").val("DVR");
                $("#new-dvr").show();

                $("#new-computador").hide();
                $("#new-tv").hide();
                $("#new-cable").hide();
                $("#new-regulador").hide();
                $("#new-ups").hide();
                $("#new-switch").hide();
                $("#new-ap").hide();
            }
        });

        $("#equipo-modulo").change(function() {
            var value = $(this).val();
            switch(value) {
                case "COMPUTADOR":
                    $("#new-computador").show();
                    $("#new-tv").hide();
                    $("#new-cable").hide();
                    $("#new-regulador").hide();
                    $("#new-ups").hide();
                    $("#new-switch").hide();
                    $("#new-ap").hide();
                break;
                case "TV":
                    $("#new-computador").hide();
                    $("#new-tv").show();
                    $("#new-cable").hide();
                    $("#new-regulador").hide();
                    $("#new-ups").hide();
                    $("#new-switch").hide();
                    $("#new-ap").hide();
                break;
                case "CABLE":
                    $("#new-computador").hide();
                    $("#new-tv").hide();
                    $("#new-cable").show();
                    $("#new-regulador").hide();
                    $("#new-ups").hide();
                    $("#new-switch").hide();
                    $("#new-ap").hide();
                break;
                case "REGULADOR":
                    $("#new-computador").hide();
                    $("#new-tv").hide();
                    $("#new-cable").hide();
                    $("#new-regulador").show();
                    $("#new-ups").hide();
                    $("#new-switch").hide();
                    $("#new-ap").hide();
                break;
                case "UPS":
                    $("#new-computador").hide();
                    $("#new-tv").hide();
                    $("#new-cable").hide();
                    $("#new-regulador").hide();
                    $("#new-ups").show();
                    $("#new-switch").hide();
                    $("#new-ap").hide();
                break;
                case "SWITCH":
                    $("#new-computador").hide();
                    $("#new-tv").hide();
                    $("#new-cable").hide();
                    $("#new-regulador").hide();
                    $("#new-ups").hide();
                    $("#new-switch").show();
                    $("#new-ap").hide();
                break;
                case "AP":
                    $("#new-computador").hide();
                    $("#new-tv").hide();
                    $("#new-cable").hide();
                    $("#new-regulador").hide();
                    $("#new-ups").hide();
                    $("#new-switch").hide();
                    $("#new-ap").show();
                break;
            }
        });

        $("#equipo-ponton").change(function() {
            var value = $(this).val();
            switch(value) {
                case "DVR":
                    $("#new-dvr").show();
                    $("#new-ap-modulo").hide();
                    $("#new-camara").hide();
                    $("#new-broadcast").hide();
                break;
                case "AP":
                    $("#new-dvr").hide();
                    $("#new-ap-modulo").show();
                    $("#new-camara").hide();
                    $("#new-broadcast").hide();
                break;
                case "CAMARAS":
                    $("#new-dvr").hide();
                    $("#new-ap-modulo").hide();
                    $("#new-camara").show();
                    $("#new-broadcast").hide();
                break;
                case "BROADCAST":
                    $("#new-dvr").hide();
                    $("#new-ap-modulo").hide();
                    $("#new-camara").hide();
                    $("#new-broadcast").show();
                break;
            }
        });

        /* ------------------------------------------------ */
        /* -------------------- MÓDULO -------------------- */
        /* ------------------------------------------------ */
        $("#new-computador").on("submit", function(e){
            e.preventDefault();

            var cotizacion_id = $("#cotizacion_id").val();
            var formData = new FormData(document.getElementById("new-computador"));
            formData.append("cotizacion_id", cotizacion_id);
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "{{ url('/pc/store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#computadores").empty();
                    $("#computadores").html(data);
                    alert("Computador agregado exitosamente");
                    updatePontonTitle();
                }
            });
        });

        $(document).on('click', "[name='edit-pc']", function() {
            var id = $(this).data('id');
            var token = '{{ csrf_token() }}';
            var data = {id: id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/pc/edit') }}",
                data: data,
                success: function (html) {
                    $("#edit-data").empty();
                    $("#edit-data").html(html);
                    $("#edit-title").html("Edición de computadores");
                }
            });
        });

        $(document).on('click', "[name='del-pc']", function() {
            var id = $(this).data('id');
            var cotizacion_id = $('#cotizacion_id').val();
            var token = '{{ csrf_token() }}';
            var data = {id: id, cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/pc/delete') }}",
                data: data,
                success: function (html) {
                    $("#computadores").empty();
                    $("#computadores").html(html);
                    alert("Computador eliminado exitosamente");
                    updatePontonTitle();
                }
            });
        });

        $("#new-tv").on("submit", function(e){
            e.preventDefault();

            var cotizacion_id = $("#cotizacion_id").val();
            var formData = new FormData(document.getElementById("new-tv"));
            formData.append("cotizacion_id", cotizacion_id);
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "{{ url('/tv/store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#tvs").empty();
                    $("#tvs").html(data);
                    alert("Televisor agregado exitosamente");
                    updatePontonTitle();
                }
            });
        });

        $(document).on('click', "[name='edit-tv']", function() {
            var id = $(this).data('id');
            var token = '{{ csrf_token() }}';
            var data = {id: id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/tv/edit') }}",
                data: data,
                success: function (html) {
                    $("#edit-data").empty();
                    $("#edit-data").html(html);
                    $("#edit-title").html("Edición de televisores");
                }
            });
        });

        $(document).on('click', "[name='del-tv']", function() {
            var id = $(this).data('id');
            var cotizacion_id = $('#cotizacion_id').val();
            var token = '{{ csrf_token() }}';
            var data = {id: id, cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/tv/delete') }}",
                data: data,
                success: function (html) {
                    $("#tvs").empty();
                    $("#tvs").html(html);
                    alert("Televisor eliminado exitosamente");
                    updatePontonTitle();
                }
            });
        });

        $("#new-cable").on("submit", function(e){
            e.preventDefault();

            var cotizacion_id = $("#cotizacion_id").val();
            var formData = new FormData(document.getElementById("new-cable"));
            formData.append("cotizacion_id", cotizacion_id);
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "{{ url('/cable/store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#cables").empty();
                    $("#cables").html(data);
                    alert("Cable agregado exitosamente");
                    updatePontonTitle();
                }
            });
        });

        $(document).on('click', "[name='edit-cable']", function() {
            var id = $(this).data('id');
            var token = '{{ csrf_token() }}';
            var data = {id: id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/cable/edit') }}",
                data: data,
                success: function (html) {
                    $("#edit-data").empty();
                    $("#edit-data").html(html);
                    $("#edit-title").html("Edición de cables");
                }
            });
        });

        $(document).on('click', "[name='del-cable']", function() {
            var id = $(this).data('id');
            var cotizacion_id = $('#cotizacion_id').val();
            var token = '{{ csrf_token() }}';
            var data = {id: id, cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/cable/delete') }}",
                data: data,
                success: function (html) {
                    $("#cables").empty();
                    $("#cables").html(html);
                    alert("Cable eliminado exitosamente");
                    updatePontonTitle();
                }
            });
        });

        $("#new-regulador").on("submit", function(e){
            e.preventDefault();

            var cotizacion_id = $("#cotizacion_id").val();
            var formData = new FormData(document.getElementById("new-regulador"));
            formData.append("cotizacion_id", cotizacion_id);
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "{{ url('/regulador/store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#reguladores").empty();
                    $("#reguladores").html(data);
                    alert("Regulador agregado exitosamente");
                    updatePontonTitle();
                }
            });
        });

        $(document).on('click', "[name='edit-regulador']", function() {
            var id = $(this).data('id');
            var token = '{{ csrf_token() }}';
            var data = {id: id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/regulador/edit') }}",
                data: data,
                success: function (html) {
                    $("#edit-data").empty();
                    $("#edit-data").html(html);
                    $("#edit-title").html("Edición de reguladores");
                }
            });
        });

        $(document).on('click', "[name='del-regulador']", function() {
            var id = $(this).data('id');
            var cotizacion_id = $('#cotizacion_id').val();
            var token = '{{ csrf_token() }}';
            var data = {id: id, cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/regulador/delete') }}",
                data: data,
                success: function (html) {
                    $("#reguladores").empty();
                    $("#reguladores").html(html);
                    alert("Regulador eliminado exitosamente");
                    updatePontonTitle();
                }
            });
        });

        $("#new-ups").on("submit", function(e){
            e.preventDefault();

            var cotizacion_id = $("#cotizacion_id").val();
            var formData = new FormData(document.getElementById("new-ups"));
            formData.append("cotizacion_id", cotizacion_id);
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "{{ url('/ups/store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#ups").empty();
                    $("#ups").html(data);
                    alert("Ups agregado exitosamente");
                    updatePontonTitle();
                }
            });
        });

        $(document).on('click', "[name='edit-ups']", function() {
            var id = $(this).data('id');
            var token = '{{ csrf_token() }}';
            var data = {id: id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/ups/edit') }}",
                data: data,
                success: function (html) {
                    $("#edit-data").empty();
                    $("#edit-data").html(html);
                    $("#edit-title").html("Edición de ups");
                }
            });
        });

        $(document).on('click', "[name='del-ups']", function() {
            var id = $(this).data('id');
            var cotizacion_id = $('#cotizacion_id').val();
            var token = '{{ csrf_token() }}';
            var data = {id: id, cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/ups/delete') }}",
                data: data,
                success: function (html) {
                    $("#ups").empty();
                    $("#ups").html(html);
                    alert("Ups eliminado exitosamente");
                    updatePontonTitle();
                }
            });
        });

        $("#new-switch").on("submit", function(e){
            e.preventDefault();

            var cotizacion_id = $("#cotizacion_id").val();
            var formData = new FormData(document.getElementById("new-switch"));
            formData.append("cotizacion_id", cotizacion_id);
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "{{ url('/switch/store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#switchs").empty();
                    $("#switchs").html(data);
                    alert("Switch agregado exitosamente");
                    updatePontonTitle();
                }
            });
        });

        $(document).on('click', "[name='edit-switch']", function() {
            var id = $(this).data('id');
            var token = '{{ csrf_token() }}';
            var data = {id: id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/switch/edit') }}",
                data: data,
                success: function (html) {
                    $("#edit-data").empty();
                    $("#edit-data").html(html);
                    $("#edit-title").html("Edición de switchs");
                }
            });
        });

        $(document).on('click', "[name='del-switch']", function() {
            var id = $(this).data('id');
            var cotizacion_id = $('#cotizacion_id').val();
            var token = '{{ csrf_token() }}';
            var data = {id: id, cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/switch/delete') }}",
                data: data,
                success: function (html) {
                    $("#switchs").empty();
                    $("#switchs").html(html);
                    alert("Switch eliminado exitosamente");
                    updatePontonTitle();
                }
            });
        });

        $("#new-ap").on("submit", function(e){
            e.preventDefault();

            var cotizacion_id = $("#cotizacion_id").val();
            var formData = new FormData(document.getElementById("new-ap"));
            formData.append("cotizacion_id", cotizacion_id);
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "{{ url('/ap/store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#ap").empty();
                    $("#ap").html(data);
                    alert("Ap agregado exitosamente");
                    updatePontonTitle();
                }
            });
        });

        $(document).on('click', "[name='edit-ap']", function() {
            var id = $(this).data('id');
            var token = '{{ csrf_token() }}';
            var data = {id: id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/ap/edit') }}",
                data: data,
                success: function (html) {
                    $("#edit-data").empty();
                    $("#edit-data").html(html);
                    $("#edit-title").html("Edición de ap");
                }
            });
        });

        $(document).on('click', "[name='del-ap']", function() {
            var id = $(this).data('id');
            var cotizacion_id = $('#cotizacion_id').val();
            var token = '{{ csrf_token() }}';
            var data = {id: id, cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/ap/delete') }}",
                data: data,
                success: function (html) {
                    $("#ap").empty();
                    $("#ap").html(html);
                    alert("Ap eliminado exitosamente");
                    updatePontonTitle();
                }
            });
        });

        /* ------------------------------------------------ */
        /* -------------------- PONTÓN -------------------- */
        /* ------------------------------------------------ */
        $("#new-dvr").on("submit", function(e){
            e.preventDefault();

            var cotizacion_id = $("#cotizacion_id").val();
            var formData = new FormData(document.getElementById("new-dvr"));
            formData.append("cotizacion_id", cotizacion_id);
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "{{ url('/dvr/store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#dvr").empty();
                    $("#dvr").html(data);
                    alert("Dvr agregado exitosamente");
                    updateModuloTitle();
                }
            });
        });

        $(document).on('click', "[name='edit-dvr']", function() {
            var id = $(this).data('id');
            var token = '{{ csrf_token() }}';
            var data = {id: id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/dvr/edit') }}",
                data: data,
                success: function (html) {
                    $("#edit-data").empty();
                    $("#edit-data").html(html);
                    $("#edit-title").html("Edición de dvrs");
                }
            });
        });

        $(document).on('click', "[name='del-dvr']", function() {
            var id = $(this).data('id');
            var cotizacion_id = $('#cotizacion_id').val();
            var token = '{{ csrf_token() }}';
            var data = {id: id, cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/dvr/delete') }}",
                data: data,
                success: function (html) {
                    $("#dvr").empty();
                    $("#dvr").html(html);
                    alert("Dvr eliminado exitosamente");
                    updateModuloTitle();
                }
            });
        });

        $("#new-ap-modulo").on("submit", function(e){
            e.preventDefault();

            var cotizacion_id = $("#cotizacion_id").val();
            var formData = new FormData(document.getElementById("new-ap-modulo"));
            formData.append("cotizacion_id", cotizacion_id);
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "{{ url('/ap/store_modulo') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#ap-modulo").empty();
                    $("#ap-modulo").html(data);
                    alert("Ap de módulo agregado exitosamente");
                    updateModuloTitle();
                }
            });
        });

        $(document).on('click', "[name='edit-ap-modulo']", function() {
            var id = $(this).data('id');
            var token = '{{ csrf_token() }}';
            var data = {id: id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/ap/edit_modulo') }}",
                data: data,
                success: function (html) {
                    $("#edit-data").empty();
                    $("#edit-data").html(html);
                    $("#edit-title").html("Edición de ap de módulo");
                }
            });
        });

        $(document).on('click', "[name='del-ap-modulo']", function() {
            var id = $(this).data('id');
            var cotizacion_id = $('#cotizacion_id').val();
            var token = '{{ csrf_token() }}';
            var data = {id: id, cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/ap/delete_modulo') }}",
                data: data,
                success: function (html) {
                    $("#ap-modulo").empty();
                    $("#ap-modulo").html(html);
                    alert("Ap de módulo eliminado exitosamente");
                    updateModuloTitle();
                }
            });
        });

        $("#new-camara").on("submit", function(e){
            e.preventDefault();

            var cotizacion_id = $("#cotizacion_id").val();
            var formData = new FormData(document.getElementById("new-camara"));
            formData.append("cotizacion_id", cotizacion_id);
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "{{ url('/camara/store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#camaras").empty();
                    $("#camaras").html(data);
                    alert("Camara agregado exitosamente");
                    updateModuloTitle();
                }
            });
        });

        $(document).on('click', "[name='edit-camara']", function() {
            var id = $(this).data('id');
            var token = '{{ csrf_token() }}';
            var data = {id: id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/camara/edit') }}",
                data: data,
                success: function (html) {
                    $("#edit-data").empty();
                    $("#edit-data").html(html);
                    $("#edit-title").html("Edición de camaras");
                }
            });
        });

        $(document).on('click', "[name='del-camara']", function() {
            var id = $(this).data('id');
            var cotizacion_id = $('#cotizacion_id').val();
            var token = '{{ csrf_token() }}';
            var data = {id: id, cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/camara/delete') }}",
                data: data,
                success: function (html) {
                    $("#camaras").empty();
                    $("#camaras").html(html);
                    alert("Camara eliminado exitosamente");
                    updateModuloTitle();
                }
            });
        });

        $("#new-broadcast").on("submit", function(e){
            e.preventDefault();

            var cotizacion_id = $("#cotizacion_id").val();
            var formData = new FormData(document.getElementById("new-broadcast"));
            formData.append("cotizacion_id", cotizacion_id);
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "{{ url('/broadcast/store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#broadcasts").empty();
                    $("#broadcasts").html(data);
                    alert("Broadcast agregado exitosamente");
                    updateModuloTitle();
                }
            });
        });

        $(document).on('click', "[name='edit-broadcast']", function() {
            var id = $(this).data('id');
            var token = '{{ csrf_token() }}';
            var data = {id: id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/broadcast/edit') }}",
                data: data,
                success: function (html) {
                    $("#edit-data").empty();
                    $("#edit-data").html(html);
                    $("#edit-title").html("Edición de broadcasts");
                }
            });
        });

        $(document).on('click', "[name='del-broadcast']", function() {
            var id = $(this).data('id');
            var cotizacion_id = $('#cotizacion_id').val();
            var token = '{{ csrf_token() }}';
            var data = {id: id, cotizacion_id: cotizacion_id, _token: token};
            $.ajax({
                type: "POST",
                url: "{{ url('/broadcast/delete') }}",
                data: data,
                success: function (html) {
                    $("#broadcasts").empty();
                    $("#broadcasts").html(html);
                    alert("Broadcast eliminado exitosamente");
                    updateModuloTitle();
                }
            });
        });
    </script>
@stop
