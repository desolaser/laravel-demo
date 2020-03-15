<form class="form-group" enctype="multipart/form-data" id="edit-cable" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="id" id="id" value="{{ $cable->id }}">
    <label for="tipo_cable">Tipo cable</label>
    <input class="form-control" type="text" name="tipo_cable" id="tipo_cable" value="{{ $cable->tipo_cable }}">
    <label for="longitud">Longitud</label>
    <input class="form-control" type="text" name="longitud" id="longitud" value="{{ $cable->longitud }}">
    <label for="cantidad">Cantidad</label>
    <input class="form-control" type="text" name="cantidad" id="cantidad" value="{{ $cable->cantidad }}">
    <input class="btn btn-primary" style="margin-top: 20px" type="submit" value="Actualizar">
</form>

<script>
    $("#edit-cable").on("submit", function(e){
        e.preventDefault();

        var cotizacion_id = $("#cotizacion_id").val();
        var formData = new FormData(document.getElementById("edit-cable"));
        formData.append("cotizacion_id", cotizacion_id);
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "{{ url('/cable/update') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $("#cables").empty();
                $("#cables").html(data);
                alert("Cable editado exitosamente");
            }
        });
    });
</script>