<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
                text-align:center;
            }
            table {
                width: 100%;
                text-align: center;
                border-collapse: collapse;
                margin: 0 auto;
            }
            td, th {
                padding: 0.3em;
                border: 1px solid #000;
            }
        </style>
    </head>
    <body>
        <h2>Trabajos cotización {{ $id }}</h2>
        @if($data != "[]")
            <table id="table" class="center">
                <thead>
                    <tr>
                        <th scope="col">Intervención</th>
                        <th scope="col">OT</th>
                        <th scope="col">GD</th>
                        <th scope="col">fecha_ingreso</th>
                        <th scope="col">fecha_retorno</th>
                        <th scope="col">trabajadores</th>
                    </tr>
                </thead>    
                <tbody>
                    @foreach($data as $item)
                        <tr>
                            <th scope="row">{{ $item->motivo }}</th>
                            <td>{{ $item->OT }}</td>
                            <td>{{ $item->GD }}</td>
                            <td>{{ $item->fecha_ingreso }}</td>
                            <td>{{ $item->fecha_retorno }}</td>
                            <td>
                                <ul>
                                    @foreach($item->trabajadores as $trabajador)
                                        <li>{{ $trabajador->nombre }}</li>
                                    @endforeach
                                </ul>
                            </td>
                    @endforeach
                </tbody>
            </table>
        @else
            <div style="padding: 20px">
                </h3>No hay trabajos asociados a esta cotización</h3>
            </div>
        @endif
    </body>
</html>