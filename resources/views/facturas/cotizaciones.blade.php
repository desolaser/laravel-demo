<style>
    .data-button{
        float: right;
    }
</style>

@if($cotizaciones != "[]")
<ul class="list-group">
    @foreach($cotizaciones as $item)
        <li class="list-group-item">
            <a>
                {{ $item->cotizacion_id }}
            </a>
            <a class="data-button" name="del_cotizacion" data-id="{{ $item->id }}">
                <span class="oi oi-circle-x"></span>
            </a>
        </li>
    @endforeach
</ul>
@else
    <p>No hay cotizaciones seleccionadas</p>
@endif
