<style>
    .data{
        float: left;
        padding: 10px;
        margin: 10px;
        width: 80%;
        background-color: #EEEEEE;
    }
    .data-button{
        float: right;
        padding: 9px;
        margin: 10px;
        width: 10%;
    }
</style>

<div class="box box-info">
    <input type="hidden" name="edicion_trabajadores_id" id="edicion_trabajadores_id" value="{{ $trabajo->id }}">    
    <div class="box-body">
        @foreach($trabajo->trabajadores as $trabajador)
            <div class="worker">
                <div class="data">
                    {{ $trabajador->nombre }}
                </div>
                <a class="btn btn-primary data-button" name="del_worker" data-id="{{ $trabajador->id }}">
                    <span class="oi oi-circle-x"></span>
                </a>
            </div>
        @endforeach
    </div>
    <div class="box-body">
        <div class="form-group">
            <label for="nombre" class="col-sm-2 control-label">Trabajador</label>
            <div class="col-sm-10">
                <select name="trabajador_id" id="trabajador_id" class="form-control">
                    <option value="">Seleccione un trabajador</option>
                    @foreach($trabajadores as $trabajador)
                        <option value="{{ $trabajador->id }}" {{ old('trabajador_id') == $trabajador->id ? 'selected' : '' }}>
                            {{ $trabajador->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>