<style>
    table {
        font-size: 10px;
        font-family: 'Courier New', Courier, monospace;
    }
</style>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead class="thead-dark">
            <tr>
                <th width="30px">#</th>
                <th>Nombre</th>
                <th>Categoria</th>
                <th>Unidad</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th class="text-center">
                    <i class="fa fa-plus"></i>
                </th>
            </tr>
            </thead>

            <tbody>
            @php
            $i = 1;
            @endphp
            @foreach ($data as $item)

            <tr>
                <th scope="row">{{ $i++ }}</th>
                <td>{{ $item->producto->nombre }}</td>
                <td>{{ $item->producto->categoria->nombre }}</td>
                <td>{{ $item->producto->unidad }}</td>
                <td>{{ $item->precio }}</td>
                <td><input type="text" value="1" id="{{ 'cantidad' . $item->id }}" size="6px"></td>
                <td class="text-center">
                    <button type="button" class="btn btn-primary btn-sm" data-id="{{ $item->id }}" name='add'>
                        <i class="fa fa-plus"></i>
                    </button>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $("[name='add']").click(function() {
            var id = $(this).data('id');
            var cantidad = $('#cantidad' + id).val();
            var id_unique =  $('#id_unique').val();
            var viatico =  $('#viatico').val();
            var descuento =  $('#descuento').val();
            var token = '{{csrf_token()}}';
            var data =  {id_unique: id_unique, id: id, cantidad: cantidad, viatico: viatico, descuento: descuento, _token: token, pagina: 'getProductos'};

            $.ajax({
                type: "POST",
                url: "{{ url('cotizaciones/setProductos/') }}",
                data: data,
                success: function (html) {
                    $("#detalle").empty();
                    $("#detalle").html(html);
                    window.alert("Producto agregado");
                }
            });
        });
    </script>


