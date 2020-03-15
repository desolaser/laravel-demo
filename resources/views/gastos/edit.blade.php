<div class="box box-info">
    <input type="hidden" name="gasto_id" id="gasto_id" value="{{ $gasto->id }}">
    <div class="box-body">
        <div class="form-group">
            <label for="nombre" class="col-sm-4 control-label">Nombre</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="edit_nombre" value="{{ $gasto->nombre }}">
            </div>
        </div>
        <div class="form-group">
            <label for="nombre" class="col-sm-4 control-label">Gasto</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" id="edit_gasto" value="{{ $gasto->gasto }}">
            </div>
        </div>
        <div class="form-group">
            <label for="nombre" class="col-sm-4 control-label">Número boleta</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="edit_numero_boleta" value="{{ $gasto->numero_boleta }}">
            </div>
        </div>
        <div class="form-group">
            <label for="edit_tipo" class="col-sm-4 control-label">Tipo</label>
            <div class="col-sm-8">
                <select class="form-control" name="edit_tipo" id="edit_tipo" value="{{ $gasto->tipo }}">
                    <option value="Hotelería" {{ old('edit_tipo', $gasto->tipo == 'Hotelería') ? 'selected' : '' }}>Hotelería</option>
                    <option value="Alimentación" {{ old('edit_tipo', $gasto->tipo == 'Alimentación') ? 'selected' : '' }}>Alimentación</option>
                    <option value="Pasajes" {{ old('edit_tipo', $gasto->tipo == 'Pasajes') ? 'selected' : '' }}>Pasajes</option>
                    <option value="Combustible" {{ old('edit_tipo', $gasto->tipo == 'Combustible') ? 'selected' : '' }}>Combustible</option>
                    <option value="Otros" {{ old('edit_tipo', $gasto->tipo == 'Otros') ? 'selected' : '' }}>Otros</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="nombre" class="col-sm-4 control-label">Fecha</label>
            <div class="col-sm-8">
                <input type="date" class="form-control" id="edit_fecha" value="{{ $gasto->fecha }}">
            </div>
        </div>
    </div>
</div>