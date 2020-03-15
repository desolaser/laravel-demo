<style>
    .data-button{
        float: right;
    }
</style>

@if($files != "[]")
<ul class="list-group">
    @foreach($files as $item)
        <li class="list-group-item">
            <a name="get_file" href="{{ url("facturas/getTempFile/{$item->id}") }}">
                {{ $item->nombre }}
            </a>
            <a class="data-button" name="del_file" data-id="{{ $item->id }}">
                <span class="oi oi-circle-x"></span>
            </a>
        </li>
    @endforeach
</ul>
@else
    <p>No hay documentos en esta cotización</p>
@endif
