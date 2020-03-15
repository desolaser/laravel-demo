<form class="form-group" enctype="multipart/form-data" id="edit-camara" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="id" id="id" value="{{ $camara->id }}">
    <label for="serial">Serial</label>
    <input class="form-control" type="text" name="serial" id="serial" value="{{ $camara->serial }}">
    <label for="marca">Marca</label>
    <input class="form-control" type="text" name="marca" id="marca" value="{{ $camara->marca }}">
    <label for="modelo">Modelo</label>
    <input class="form-control" type="text" name="modelo" id="modelo" value="{{ $camara->modelo }}">
    <label for="usuario">Usuario</label>
    <input class="form-control" type="text" name="usuario" id="usuario" value="{{ $camara->usuario }}">
    <label for="clave">Clave</label>
    <input class="form-control" type="text" name="clave" id="clave" value="{{ $camara->clave }}">
    <label for="serial_p2p">Serial P2P</label>
    <input class="form-control" type="text" name="serial_p2p" id="serial_p2p" value="{{ $camara->serial_p2p }}">
    <label for="ip">IP</label>
    <input class="form-control" type="text" name="ip" id="ip" value="{{ $camara->ip }}">
    <label for="mac_address">Mac address</label>
    <input class="form-control" type="text" name="mac_address" id="mac_address" value="{{ $camara->mac_address }}">
    <label for="nombre">Nombre</label>
    <input class="form-control" type="text" name="nombre" id="nombre" value="{{ $camara->nombre }}">
    <label for="firmware">Firmware</label>
    <input class="form-control" type="text" name="firmware" id="firmware" value="{{ $camara->firmware }}">
    <label for="backup">Backup</label>
    <input class="form-control" type="text" name="backup" id="backup" value="{{ $camara->backup }}">
    <input class="btn btn-primary" style="margin-top: 20px" type="submit" value="Actualizar">
</form>

<script>
    $("#edit-camara").on("submit", function(e){
        e.preventDefault();

        var cotizacion_id = $("#cotizacion_id").val();
        var formData = new FormData(document.getElementById("edit-camara"));
        formData.append("cotizacion_id", cotizacion_id);
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "{{ url('/camara/update') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $("#camaras").empty();
                $("#camaras").html(data);
                alert("Camara editada exitosamente");
            }
        });
    });
</script>