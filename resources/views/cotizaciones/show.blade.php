<!DOCTYPE html>
<html>
    <head>
        <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('js/report.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/report.css') }}">
    </head>
    <body>
        <div class="container">
            <center><h1>Cotización</h1></center>
            <div class="separator"></div>
            <div class="row company-data" style="padding: 20px">
                <img src=" {{ asset('img/microwave-logo.png') }}">
                <p class="company-desc" align="left">
                    Servicios venta y manutención<br/>
                    de equipos electrónicos acuícolas.<br/>
                    Email: underwater.microwave@gmail.com
                </p>
            </div>
            <div class="client-data">
                <p class="list-client-data" align="left">
                        Cliente: {{ $data->empresa->nombre }}<br/>
                        Fecha atención: {{ $data->created_at->toDateString() }}<br/>
                        Centro: {{ $data->centro->nombre }}<br/>
                        Zona: {{ $data->contacto->zona }}<br/>
                        Nota: {{ $data->nota }}<br/>
                </p>
                <div class="budget-number">
                    <h1 class="num">N: {{ $data->id }}</h1>
                </div>  
            </div>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <div class="separator"></div>
            <h2> Detalle cotización </h2>
            <table class="table">
                <thead>
                    <tr>
                        <th width="30px">Cantidad</th>
                        <th align="center">Descripción</th>
                        <th width="100px">Precio unitario</th>
                        <th width="100px">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i=1;
                        $x = 1;
                        $id = ($productos) ? $productos[0]->servicio_id : 0;
                    @endphp
                    @foreach ($productos as $item)
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
                            <th scope="row">{{ $item->cantidad }}</th>
                            <td>{{ $item->producto->nombre }}</td>
                            <td class="text-right">{{ $item->precio }}</td>
                            <td class="text-right">{{ $item->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row justify-content-end">
                <table class="res-table col-6">
                    <thead>
                        <tr>
                            <td width = "50%">Gastos asociados a viajes y otros</td>
                            <td id="viatico" width="100px">{{ $data->viatico }}</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width = "50%">Sumatoria</td>
                            <td id="sumatoria" width="100px">{{ $data->sumatoria }}</td>
                        </tr>
                        @if(strcmp($data->descuento, '0') != 0)
                            <tr>
                                <td width = "50%">Descuento</td>
                                <td id="descuento" width="100px">{{ $data->descuento }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td width = "50%">Subtotal</td>
                            <td id="subtotal" width="100px">{{ $data->subtotal }}</td>
                        </tr>
                        <tr>
                            <td width = "50%">Impuesto</td>
                            <td id="impuesto" width="100px">{{ $data->impuesto }}</td>
                        </tr>
                        <tr>
                            <td width = "50%">Total</td>
                            <td id="total" width="100px">{{ $data->total }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <p class="list-client-data blue" align="left">
                        Razón Social: TELECOMUNICACIONES MICROWAVE SPA<br/>
                        RUT: 76.252.984-K<br/>
                        Dirección: Ruta 5 Km. 1025 Chinquihue Alto<br/>
                        Giro: Servicios venta y manutención de equipos<br/>
                        electrónicos acuícolas<br/>
                        Ciudad: Puerto Montt<br/>
                </p> 
            </div> 
        </div>
    </body>
</html>