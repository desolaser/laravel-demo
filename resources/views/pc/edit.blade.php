<form class="form-group" enctype="multipart/form-data" id="edit-computador" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="id" id="id" value="{{ $pc->id }}">
    <label for="serial">Serial</label>
    <input class="form-control" type="text" name="serial" id="serial" value="{{ $pc->serial }}">
    <label for="modelo">Modelo</label>
    <input class="form-control" type="text" name="modelo" id="modelo" value="{{ $pc->modelo }}">
    <label for="tipo">Tipo</label>
    <input class="form-control" type="text" name="tipo" id="tipo" value="{{ $pc->tipo }}">
    <label for="placa_madre">Placa madre</label>
    <input class="form-control" type="text" name="placa_madre" id="placa_madre" value="{{ $pc->placa_madre }}">
    <label for="fuente_poder">Fuente de poder</label>
    <input class="form-control" type="text" name="fuente_poder" id="fuente_poder" value="{{ $pc->fuente_poder }}">
    <label for="procesador">Procesador</label>
    <input class="form-control" type="text" name="procesador" id="procesador" value="{{ $pc->procesador }}">
    <label for="teclado">Teclado</label>
    <input class="form-control" type="text" name="teclado" id="teclado" value="{{ $pc->teclado }}">
    <label for="mouse">Mouse</label>
    <input class="form-control" type="text" name="mouse" id="mouse" value="{{ $pc->mouse }}">
    <label for="ram">Ram</label>
    <input class="form-control" type="text" name="ram" id="ram" value="{{ $pc->ram }}">
    <label for="disco_duro">Disco duro</label>
    <input class="form-control" type="text" name="disco_duro" id="disco_duro" value="{{ $pc->disco_duro }}">
    <label for="ram">Memoria RAM</label>
    <input class="form-control" type="text" name="ram" id="ram" value="{{ $pc->ram }}">
    <label for="tarjeta_video">Tarjeta Gráfica</label>
    <input class="form-control" type="text" name="tarjeta_video" id="tarjeta_video" value="{{ $pc->tarjeta_video }}">
    <label for="wifi">Tarjeta WiFi</label>
    <input class="form-control" type="text" name="wifi" id="wifi" value="{{ $pc->wifi }}">
    <input class="btn btn-primary" style="margin-top: 20px" type="submit" value="Actualizar">
</form>

<script>
    $("#edit-computador").on("submit", function(e){
        e.preventDefault();

        var cotizacion_id = $("#cotizacion_id").val();
        var formData = new FormData(document.getElementById("edit-computador"));
        formData.append("cotizacion_id", cotizacion_id);
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "{{ url('/pc/update') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $("#computadores").empty();
                $("#computadores").html(data);
                alert("Computador editado exitosamente");
            }
        });
    });
</script>