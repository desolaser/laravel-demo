<style>
    .data-button{
        float: right;
    }
</style>

@if($facturas != "[]")
<ul class="list-group">
    @foreach($facturas as $item)
        <li class="list-group-item">
            <a name="bill">
                {{ $item->factura_id }}
            </a>
            <a class="data-button" name="del_bill" data-id="{{ $item->id }}">
                <span class="oi oi-circle-x"></span>
            </a>
        </li>
    @endforeach
</ul>
@else
    <p>No hay facturas seleccionadas</p>
@endif
