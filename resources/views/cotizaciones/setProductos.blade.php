<input type="text" name="registros" value="{{ $registros }}">
<input type="text" name="sumatoria" id="sumatoria" value="{{ $sumatoria }}">
<input type="text" name="subtotal" id="subtotal" value="{{ $subtotal }}">
<input type="text" name="impuesto" id="impuesto" value="{{ $impuesto }}">
<input type="text" name="total" id="total" value="{{ $total }}">
@if( !$data->isEmpty())
    <table class="table table-striped table-sm">
        <thead class="thead-dark">
            <tr>
                <th width="30px">#</th>
                <th>Nombre</th>
                <th>Unidad</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th width="90px" class="text-center">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                </th>
            </tr>
        </thead>
        <tbody>
            @php
                $i=1;
                $x = 1;
                $id = ($data) ? $data[0]->servicio_id : 0;
            @endphp
            @foreach ($data as $item)
                @if ($x == 1)
                    <tr class="text-center alert alert-success">
                        <td colspan="7"><?= $item->servicio->nombre; ?></td>
                    </tr>
                    @php
                        $x = 0;
                    @endphp
                @endif
                @if ($id != $item->servicio_id)
                    <tr class="text-center alert alert-success">
                        <td colspan="7"><?= $item->servicio->nombre; ?></td>
                    </tr>
                    @php
                        $id = $item->servicio_id;
                    @endphp
                @endif
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $item->producto->nombre }}</td>
                    <td class="text-right">{{ $item->producto->unidad }}</td>
                    <td class="text-right">{{ number_format($item->precio) }}</td>
                    <td class="text-right">
                        <input type="text" class="custom-control-input" style="width: 70%;" id="{{ 'cantidad' . $item->id }}" value="{{ number_format($item->cantidad) }}">                        
                        <button type="button" class="btn btn-primary btn-sm" data-id="{{ $item->id }}" data-det_cotizacion_id="{{ $item->det_cotizacion_id }}" name='amount'>
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                    <td class="text-right">{{ number_format($item->total) }}</td>
                    <th width="90px" class="text-center">
                        <button type="button" class="btn btn-primary btn-sm" data-id="{{ $item->id }}" data-det_cotizacion_id="{{ $item->det_cotizacion_id }}" name='del'>
                            <i class="fa fa-trash-o"></i>
                        </button>
                    </th>
                </tr>
            @endforeach
            @if ($viatico > 0)
                <tr class="text-center alert alert-success">
                    <td colspan="7">GASTOS ASOCIADOS A VIAJES Y OTROS</td>
                </tr>
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>GASTOS ASOCIADO AL VIAJE (INCLUYE GASTO DE MOVILIZACIÓN PARA 2 TECNICOS, VEHICULO, TRANSBORDADORES, PEAJE). NO INCLUYE HOSPEDAJE NI ALIMENTANCIÓN</td>
                    <td class="text-right">Monto</td>
                    <td class="text-right">{{ number_format($viatico) }}</td>
                    <td class="text-right">1</td>
                    <td class="text-right">{{ number_format($viatico) }}</td>
                    <th width="90px" class="text-center"></th>
                </tr>
            @endif
            <tr class="text-right">
    			<td colspan="5">SUMATORIA</td>
    			<td>{{ number_format($sumatoria) }}</td>
    			<td></td>
            </tr>
            @if ($descuento > 0)
                <tr class="text-right">
                    <td colspan="5">DESCUENTO</td>
                    <td>{{ number_format($descuento) }}</td>
                    <td></td>
                </tr>
                
                <tr class="text-right">
                    <td colspan="5">SUB-TOTAL</td>
                    <td>{{ number_format($subtotal) }}</td>
                    <td></td>
                </tr>
            @endif

    		<tr class="text-right">
    			<td colspan="5">IVA (19%)</td>
    			<td>{{ number_format($impuesto) }}</td>
    			<td></td>
    		</tr>
    		<tr class="text-right">
    			<td colspan="5">TOTAL</td>
    			<td>{{ number_format($total) }}</td>
    			<td></td>
    		</tr>
        </tbody>
    </table>
@else
    <table class="table table-striped table-sm">
        <thead class="thead-dark">
            <tr>
                <th width="30px">#</th>
                <th>Nombre</th>
                <th>Unidad</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th width="90px" class="text-center">
                    <i class="fa fa-trash-o" aria-hidden="true"></i></button>
                </th>
            </tr>
        </thead>
        <tbody>
            @if ($viatico > 0)
                <tr class="text-center alert alert-success">
                    <td colspan="7">GASTOS ASOCIADOS A VIAJES Y OTROS</td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td>GASTOS ASOCIADO AL VIAJE (INCLUYE GASTO DE MOVILIZACIÓN PARA 2 TECNICOS, VEHICULO, TRANSBORDADORES, PEAJE). NO INCLUYE HOSPEDAJE NI ALIMENTANCIÓN</td>
                    <td class="text-right">Monto</td>
                    <td class="text-right">{{ number_format($viatico) }}</td>
                    <td class="text-right">1</td>
                    <td class="text-right">{{ number_format($viatico) }}</td>
                    <th width="90px" class="text-center"></th>
                </tr>
            @endif
            <tr class="text-right">
                <td colspan="5">SUMATORIA</td>
                <td>{{ number_format($sumatoria) }}</td>
                <td></td>
            </tr>
            @if ($descuento > 0)
                <tr class="text-right">
                    <td colspan="5">DESCUENTO</td>
                    <td>{{ number_format($descuento) }}</td>
                    <td></td>
                </tr>
                
                <tr class="text-right">
                    <td colspan="5">SUB-TOTAL</td>
                    <td>{{ number_format($subtotal) }}</td>
                    <td></td>
                </tr>
            @endif

            <tr class="text-right">
                <td colspan="5">IVA (19%)</td>
                <td>{{ number_format($impuesto) }}</td>
                <td></td>
            </tr>
            <tr class="text-right">
                <td colspan="5">TOTAL</td>
                <td>{{ number_format($total) }}</td>
                <td></td>
            </tr>
        </tbody>
    </table>
@endif    
    <script>
        $("[name='amount']").click(function() {

            var id = $(this).data('id');
            var cantidad = $('#cantidad' + id).val();
            var id_unique =  $('#id_unique').val();
            var viatico =  $('#viatico').val();
            var descuento =  $('#descuento').val();

            var cantidad = parseFloat(cantidad.replace(/,/g, ''));
            var isnum = /^\d+$/.test(cantidad);
            if (!isnum) {
                window.alert("Se debe ingresar un valor numérico");
                return;
            }

            var token = '{{csrf_token()}}';
            var data =  {id_unique: id_unique, id: id, cantidad: cantidad, viatico: viatico, descuento: descuento, _token: token, pagina: 'setCantidad'};

            $.ajax({
                type: "POST",
                url: "{{ url('cotizaciones/setProductos/') }}",
                data: data,
                success: function (html) {
                    $("#detalle").empty();
                    $("#detalle").html(html);
                    window.alert("Cantidad editada");
                }
            });
        });
    </script>