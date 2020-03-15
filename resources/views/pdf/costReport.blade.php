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
            .trabajo {
                
            }
        </style>
    </head>
    <body>
        <h2>Gastos cotización {{ $id }}</h2>
        @if($data != "[]")
            @php
                $i = 0
            @endphp
            @foreach($data as $item)
                <div class="trabajo" style="padding: 10px">
                    <h2>Intervención: {{ $trabajos[$i]->motivo }}</h2>
                </div>
                <table class="center">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Gasto</th>
                            <th scope="col">Número boleta</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Fecha</th>
                        </tr>
                    </thead>    
                    <tbody>
                        @foreach($item as $gasto)
                            <tr>
                                <th scope="row">{{ $gasto->nombre }}</th>
                                <td>{{ $gasto->gasto }}</td>
                                <td>{{ $gasto->numero_boleta }}</td>
                                <td>{{ $gasto->tipo }}</td>
                                <td>{{ $gasto->fecha }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @php
                    $i++
                @endphp
            @endforeach
        @else
            <div style="padding: 20px">
                </h3>No hay gastos asociados a este trabajo</h3>
            </div>
        @endif
    </body>
</html>