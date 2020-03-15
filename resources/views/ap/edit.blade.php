<form class="form-group" enctype="multipart/form-data" id="edit-ap" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="id" id="id" value="{{ $ap->id }}">
    <label for="serial">Serial</label>
    <input class="form-control" type="text" name="serial" id="serial" value="{{ $ap->serial }}">
    <label for="marca">Marca</label>
    <input class="form-control" type="text" name="marca" id="marca" value="{{ $ap->marca }}">
    <label for="modelo">Modelo</label>
    <input class="form-control" type="text" name="modelo" id="modelo" value="{{ $ap->modelo }}">
    <label for="usuario">Usuario</label>
    <input class="form-control" type="text" name="usuario" id="usuario" value="{{ $ap->usuario }}">
    <label for="clave">Clave</label>
    <input class="form-control" type="text" name="clave" id="clave" value="{{ $ap->clave }}">
    <label for="ssid">SSID</label>
    <input class="form-control" type="text" name="ssid" id="ssid" value="{{ $ap->ssid }}">
    <label for="wifi">Wifi</label>
    <input class="form-control" type="text" name="wifi" id="wifi" value="{{ $ap->wifi }}">
    <label for="ip">IP</label>
    <input class="form-control" type="text" name="ip" id="ip" value="{{ $ap->ip }}">
    <label for="firmware">Firmware</label>
    <input class="form-control" type="text" name="firmware" id="firmware" value="{{ $ap->firmware }}">
    <label for="backup">Backup</label>
    <input class="form-control" type="text" name="backup" id="backup" value="{{ $ap->backup }}">
    <label for="tipo">Tipo</label>
    <input class="form-control" type="text" name="tipo" id="tipo" value="{{ $ap->tipo }}">
    <input class="btn btn-primary" style="margin-top: 20px" type="submit" value="Actualizar">
</form>

<script>
    $("#edit-ap").on("submit", function(e){
        e.preventDefault();

        var cotizacion_id = $("#cotizacion_id").val();
        var formData = new FormData(document.getElementById("edit-ap"));
        formData.append("cotizacion_id", cotizacion_id);
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "{{ url('/ap/update') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $("#ap").empty();
                $("#ap").html(data);
                alert("Ap editado exitosamente");
            }
        });
    });
</script>