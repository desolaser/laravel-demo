<div class="box box-info">
    <input type="hidden" name="material_id" id="material_id" value="{{ $material->id }}">
    <div class="box-body">
        <div class="form-group">
            <label for="edit-producto" class="col-sm-4 control-label">Producto</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="edit-producto" value="{{ $material->producto }}">
            </div>
        </div>
        <div class="form-group">
            <label for="edit-cantidad" class="col-sm-4 control-label">Cantidad</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" id="edit-cantidad" value="{{ $material->cantidad }}">
            </div>
        </div>
        <div class="form-group">
            <label for="edit-proveedor" class="col-sm-4 control-label">Proveedor</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="edit-proveedor" value="{{ $material->proveedor }}">
            </div>
        </div>
        <div class="form-group">
            <label for="edit-p_proveedor" class="col-sm-4 control-label">Precio Proveedor</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" id="edit-p_proveedor" value="{{ $material->p_proveedor }}">
            </div>
        </div>
    </div>
</div>