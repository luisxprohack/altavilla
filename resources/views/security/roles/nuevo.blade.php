<form action="{{ route('roles.store') }}" method="POST" class="formentrada" id="add-role">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <strong>Nombre del Perfil</strong>
                    <input type="text" name="nombre" class="form-control" autocomplete="off" required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <strong>Descripción</strong>
                    <input type="text" name="descripcion" class="form-control" autocomplete="off" required>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer p-0 d-block">
        <button type="button" class="btn text-tema" id="close_modal" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Salir</button>
        <button type="submit" class="btn btn-tema float-right">
            <span class="spinner-border spinner-border-sm mr-1" style="display: none;" id="loading-add-role"></span>
            <i class="fa fa-save"></i> Guardar</button>
    </div>
</form>
