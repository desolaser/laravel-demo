@extends('admin.layout')

@section('content')
    <input type="text" value="{{ $empresa_id }}" id="empresa_id">
    <input type="text" value="{{ $cotizacion_id }}" id="cotizacion_id">
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Agregar Producto</button>
    <table class="table table-striped table-sm">
        <thead class="thead-dark">
            <tr>
                <th width="30px">#</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
                <th class="text-center">Acciones</i>
                </th>
            </tr>
        </thead>
        <tbody id="detalle">
        </tbody>
    </table>


    <!-- Modal de Servicio -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Productos</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="" class="col-2 control-label">Servicio</label>

                        <div class="col-10">
                            <select name="servicio_id" id="servicio_id" class="form-control" required>
                                    <option value="">Seleccione empresa</option>
                                    @foreach($servicios as $item)
                                            <option value="{{ $item->id}}">{{ $item->nombre}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>

                    <div id="div_productos"></div>
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
        $(document).ready(function(){
            $("form").keypress(function(e) {
                if (e.which == 13) {
                    return false;
                }
            });
        });

        $("#myModal").on('change', "#servicio_id", function () {
            var empresa_id = $('#empresa_id').val();
            var servicio_id = $('#servicio_id').val();
            var token = '{{csrf_token()}}';
            var data={empresa_id: empresa_id, servicio_id: servicio_id,_token: token};
            var tabla = "";

            $.ajax({
                type: "POST",
                url: "{{ url('cotizaciones/getProductos/')}}",
                data: data,
                success: function (data) {
                    $("#div_productos").empty();
                    $("#div_productos").html(data);
                }
            });
        });
    </script>
@stop
