<p>
    Número de cotización: <b>{{ $item->id }}</b>
</p>
<p>
    Empresa: <b>{{ $item->empresa->nombre }}</b>
</p>
<p>
    Centro: <b>{{ $item->centro->nombre }}</b>
</p>
<p>
    Fecha ingreso: <b>{{ $item->created_at->toDateString() }}</b>
</p>
<a class="btn btn-primary" href="{{ url("cotizaciones/show/{$item->id}") }}">
    <i class="icon-shopping-cart icon-large"></i>Ver detalle
</a>
<a class="btn btn-primary" href="{{ url("pdf/{$item->id}") }}">
    <i class="icon-shopping-cart icon-large"></i>Descargar pdf
</a>