<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <style>
            body {
                font-family: Arial;
                font-size: 10px;
            }
            .container {
                padding-left: 5%; /* 5 */
                padding-right: 5%;
            }
            .separator {
                border: 2px solid black;
            }
            .company-data{
                width: 100%;
                height: 7%;
            }
            .company-desc {
                float: right;
                text-align: left;
            }
            .client-data{
                width: 100%;
            }
            .list-client-data {
                float: left;
                text-align: left;
            }
            .list-company-data {
                float: left;
                text-align: left;
                page-break-inside: avoid;
                background-color: #dddddd;
                padding: 10px;
            }
            .budget-number {
                float: right;
            }
            .num {
                border: 1px solid #000;
                padding: 5px;
            }
            .table-pricing {
                width: 30%;
                float: right;
                border-collapse: collapse;
            }
            .list-group-item {
                list-style-type: none;
                padding: 5px;
            }
            .bold {
                font-weight: bold;
            }
            .list-company-data {
                width: 40%;
                float: left;
                border: none;
            }
            .list-company-data td, .list-company-data th {
                border: none;
                font-weight: bold;
            }
            .list-client-data td, .list-client-data th {
                border: none;
            }
            .table {
                width: 100%;
                text-align: right;
                margin: 0 0 1em 0;
                caption-side: top;
            }
            .price-table {
                text-align: right;
                float: right;
            }
            td, th {
                padding: 0.3em;
                border: 1px solid #000;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <center><h1>Cotización</h1></center>
            <div class="separator"></div>
            <div class="company-data">
                <img src="../resources/views/pdf/logo.png" style="padding-top: 25px;">
                <p class="company-desc" align="left">
                    Servicios de ventas de productos<br/>
                    del rubro X.<br/>
                    Email: folavarria.test@gmail.com
                </p>
            </div>
            <div class="client-data">
            <p class="list-client-data" align="left">
                Cliente: {{ $data->empresa->nombre }}<br/>
                Fecha atención: {{ $data->created_at->toDateString() }}<br/>
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
                            <tr>
                                <td colspan="4" align="center" bgcolor="#c7eacd"><?= $item->servicio->nombre; ?></td>
                            </tr>
                            @php
                                $x = 0;
                            @endphp
                        @endif
                        @if ($id != $item->servicio_id)
                            <tr>
                                <td colspan="4" align="center" bgcolor="#c7eacd"><?= $item->servicio->nombre; ?></td>
                            </tr>
                            @php
                                $id = $item->servicio_id;
                            @endphp
                        @endif
                        <tr>
                            <th scope="row" class="text-right">{{ $item->cantidad }}</th>
                            <td align="left">{{ $item->producto->nombre }}</td>
                            <td class="text-right" >{{ $item->precio }}</td>
                            <td class="text-right">{{ $item->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="display:inline-block;">
                <table class="price-table">
                    <thead>
                        <tr>
                            <td width = "50%">Gastos asociados a viajes y otros</td>
                            <td width="100px">{{ $data->viatico }}</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width = "50%">Sumatoria</td>
                            <td width="100px">{{ $data->sumatoria }}</td>
                        </tr>
                        @if(strcmp($data->descuento, '0') != 0)
                            <tr>
                                <td width = "50%">Descuento</td>
                                <td width="100px">{{ $data->descuento }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td width = "50%">Subtotal</td>
                            <td width="100px">{{ $data->subtotal }}</td>
                        </tr>
                        <tr>
                            <td width = "50%">Impuesto</td>
                            <td width="100px">{{ $data->impuesto }}</td>
                        </tr>
                        <tr>
                            <td width = "50%">Total</td>
                            <td width="100px">{{ $data->total }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="saltopagina">
            </div>
            <p class="list-company-data" align="left">
                <b>Razón Social/b>: LARAVEL TEST<br/>
                <b>RUT</b>: XX.XXX.XXX-X<br/>
                <b>Dirección</b>: Ruta X Km. X<br/>
                <b>Giro</b>: Servicios de ventas de productos<br/>
                del rubro X.<br/>
                <b>Ciudad</b>: Ciudad X<br/>
            </p>
        </div>
    </body>
</html>
