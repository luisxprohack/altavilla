<form action="{{ route('inventario.store') }}" method="POST" class="formentrada" id="add-inventario">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <strong>Código</strong>
                    <input type="text" name="codigo" class="form-control form-control-sm" autocomplete="off" required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <strong>Descripción del Producto</strong>
                    <input type="text" name="descripcion" class="form-control form-control-sm" autocomplete="off" required>
                </div>
            </div>
            <div class="col-sm-6 col-12">
                <div class="form-group">
                    <strong>Tipo</strong>
                    <input type="text" name="tipo" class="form-control form-control-sm" autocomplete="off" required>
                </div>
            </div>
            <div class="col-sm-6 col-12">
                <div class="form-group">
                    <strong>Peso Unitario</strong>
                    <input type="text" name="peso_unitario" class="form-control form-control-sm" autocomplete="off" required>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer p-0 d-block">
        <button type="button" class="btn btn-link text-tema" id="close_modal" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Salir</button>
        <button type="submit" class="btn btn-tema float-right">
            <span class="spinner-border spinner-border-sm mr-1" style="display: none;" id="loading-add-inventario"></span>
            <i class="fa fa-save"></i> Guardar</button>
    </div>
</form>
