@php
if (isset($alerts)) {
    echo $alerts;
}
@endphp
@if($data != "[]")
    <div class="row bg-danger" style="padding: 10px">
        <h4>Posts</h4>
    </div>
    @foreach($data as $item)
        <div style="container">
            <div class="row bg-primary" style="padding: 10px">
                <b>Usuario:</b> {{ $item->usuario }}
            </div>
            <div class="row bg-info">
                <div style="padding: 10px; margin: 20px">
                    {{ $item->mensaje }}
                </div>
                <div style="padding: 10px; margin: 10px">
                    <b>Fecha:</b> {{ $item->created_at->toDateString() }}
                </div>
                @if ($status == "OPERACIONES")
                    @if (strcmp(Auth::user()->name, $item->usuario) == 0 ||
                            Auth::user()->role == 'SUPERUSUARIO')
                        <a class="btn btn-primary" name="del_post" data-id="{{ $item->id }}">
                            <span class="oi oi-circle-x"></span>
                        </a>
                        <!--
                        <a class="btn btn-primary" name="edit_post" data-id="{{ $item->id }}">
                            <span class="oi oi-pencil"></span>
                        </a> -->
                    @endif
                @endif
            </div>
        </div>
        <br>
    @endforeach
@else
    <div style="padding: 20px">
        </h3>No hay posts asociados a esta cotización</h3>
    </div>
@endif
