<form class="form-group" enctype="multipart/form-data" id="edit-broadcast" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="id" id="id" value="{{ $broadcast->id }}">
    <label for="serial">Serial</label>
    <input class="form-control" type="text" name="serial" id="serial" value="{{ $broadcast->serial }}">
    <label for="modelo">Modelo</label>
    <input class="form-control" type="text" name="modelo" id="modelo" value="{{ $broadcast->modelo }}">
    <label for="usuario">Usuario</label>
    <input class="form-control" type="text" name="usuario" id="usuario" value="{{ $broadcast->usuario }}">
    <label for="clave">Clave</label>
    <input class="form-control" type="text" name="clave" id="clave" value="{{ $broadcast->clave }}">
    <label for="serial_p2p">Serial P2P</label>
    <input class="form-control" type="text" name="serial_p2p" id="serial_p2p" value="{{ $broadcast->serial_p2p }}">
    <label for="ip">IP</label>
    <input class="form-control" type="text" name="ip" id="ip" value="{{ $broadcast->ip }}">
    <label for="mac_address">Mac address</label>
    <input class="form-control" type="text" name="mac_address" id="mac_address" value="{{ $broadcast->mac_address }}">
    <label for="nombre">Nombre</label>
    <input class="form-control" type="text" name="nombre" id="nombre" value="{{ $broadcast->nombre }}">
    <label for="firmware">Firmware</label>
    <input class="form-control" type="text" name="firmware" id="firmware" value="{{ $broadcast->firmware }}">
    <label for="backup">Backup</label>
    <input class="form-control" type="text" name="backup" id="backup" value="{{ $broadcast->backup }}">
    <label for="marca_dvr">Marca DVR</label>
    <input class="form-control" type="text" name="marca_dvr" id="marca_dvr" value="{{ $broadcast->marca_dvr }}">
    <label for="modelo_dvr">Modelo DVR</label>
    <input class="form-control" type="text" name="modelo_dvr" id="modelo_dvr" value="{{ $broadcast->modelo_dvr }}">
    <label for="numero_produccion">Número producción</label>
    <input class="form-control" type="number" name="numero_produccion" id="numero_produccion" value="{{ $broadcast->numero_produccion }}">
    <label for="numero_camaras">Número cámaras</label>
    <input class="form-control" type="number" name="numero_camaras" id="numero_camaras" value="{{ $broadcast->numero_camaras }}">
    <input class="btn btn-primary" style="margin-top: 20px" type="submit" value="Actualizar">
</form>

<script>
    $("#edit-broadcast").on("submit", function(e){
        e.preventDefault();

        var cotizacion_id = $("#cotizacion_id").val();
        var formData = new FormData(document.getElementById("edit-broadcast"));
        formData.append("cotizacion_id", cotizacion_id);
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "{{ url('/broadcast/update') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $("#broadcasts").empty();
                $("#broadcasts").html(data);
                alert("Broadcast editado exitosamente");
            }
        });
    });
</script>