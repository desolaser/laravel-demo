<form class="form-group" enctype="multipart/form-data" id="edit-dvr" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="id" id="id" value="{{ $dvr->id }}">
    <label for="serial">Serial</label>
    <input class="form-control" type="text" name="serial" id="serial" value="{{ $dvr->serial }}">
    <label for="marca">Marca</label>
    <input class="form-control" type="text" name="marca" id="marca" value="{{ $dvr->marca }}">
    <label for="modelo">Modelo</label>
    <input class="form-control" type="text" name="modelo" id="modelo" value="{{ $dvr->modelo }}">
    <input class="btn btn-primary" style="margin-top: 20px" type="submit" value="Actualizar">
</form>

<script>
    $("#edit-dvr").on("submit", function(e){
        e.preventDefault();

        var cotizacion_id = $("#cotizacion_id").val();
        var formData = new FormData(document.getElementById("edit-dvr"));
        formData.append("cotizacion_id", cotizacion_id);
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "{{ url('/dvr/update') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $("#dvr").empty();
                $("#dvr").html(data);
                alert("Dvr editado exitosamente");
            }
        });
    });
</script>