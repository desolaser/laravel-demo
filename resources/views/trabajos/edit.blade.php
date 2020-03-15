<div class="box box-info">
    <input type="hidden" name="trabajo_id" id="trabajo_id" value="{{ $trabajo->id }}">
    <div class="box-body">
        <div class="form-group">
            <label for="nombre" class="col-sm-4 control-label">Intervención</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="edit_motivo" value="{{ $trabajo->motivo }}">
            </div>
        </div>
        <div class="form-group">
            <label for="nombre" class="col-sm-4 control-label">OT</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="edit_OT" value="{{ $trabajo->OT }}">
            </div>
        </div>
        <div class="form-group">
            <label for="nombre" class="col-sm-4 control-label">GD</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="edit_GD" value="{{ $trabajo->GD }}">
            </div>
        </div>
        <div class="form-group">
            <label for="nombre" class="col-sm-4 control-label">Fecha ingreso</label>
            <div class="col-sm-8">
                <input type="date" class="form-control" id="edit_fecha_ingreso" value="{{ $trabajo->fecha_ingreso }}">
            </div>
        </div>
        <div class="form-group">
            <label for="nombre" class="col-sm-4 control-label">Fecha retorno</label>
            <div class="col-sm-8">
                <input type="date" class="form-control" id="edit_fecha_retorno" value="{{ $trabajo->fecha_retorno }}">
            </div>
        </div>
    </div>
</div>