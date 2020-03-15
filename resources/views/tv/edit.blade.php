<form class="form-group" enctype="multipart/form-data" id="edit-tv" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="id" id="id" value="{{ $tv->id }}">
    <label for="serial">Serial</label>
    <input class="form-control" type="text" name="serial" id="serial" value="{{ $tv->serial }}">
    <label for="marca">Marca</label>
    <input class="form-control" type="text" name="marca" id="marca" value="{{ $tv->marca }}">
    <label for="modelo">Modelo</label>
    <input class="form-control" type="text" name="modelo" id="modelo" value="{{ $tv->modelo }}">
    <label for="dimension">Dimension</label>
    <input class="form-control" type="text" name="dimension" id="dimension" value="{{ $tv->dimension }}">
    <label for="formato">Formato</label>
    <input class="form-control" type="text" name="formato" id="formato" value="{{ $tv->formato }}">
    <input class="btn btn-primary" style="margin-top: 20px" type="submit" value="Actualizar">
</form>

<script>
    $("#edit-tv").on("submit", function(e){
        e.preventDefault();

        var cotizacion_id = $("#cotizacion_id").val();
        var formData = new FormData(document.getElementById("edit-tv"));
        formData.append("cotizacion_id", cotizacion_id);
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "{{ url('/tv/update') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $("#tvs").empty();
                $("#tvs").html(data);
                alert("Televisor editado exitosamente");
            }
        });
    });
</script>