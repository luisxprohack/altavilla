<form action="{{ route('tipodocumento.store') }}" method="POST" class="formentrada" id="add-tipodocumento">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-8 col-12">
                <div class="form-group">
                    <strong>Tipo documento</strong>
                    <input type="text" name="nombre" class="form-control" autocomplete="off" required>
                </div>
            </div>
            <div class="col-sm-4 col-12">
                <div class="form-group">
                    <strong>Abreviatura</strong>
                    <input type="text" name="abreviatura" class="form-control" autocomplete="off" required>
                </div>
            </div>
            <div class="col-sm-4 col-12">
                <div class="form-group">
                    <strong>Caracteres</strong>
                    <input type="number" name="caracteres" class="form-control" autocomplete="off" required>
                </div>
            </div>
            <div class="col-sm-4 col-12">
                <div class="form-group">
                    <strong>Persona natural</strong>
                    <select name="per_natural" class="form-control">
                        <option value="1">SI</option>
                        <option value="0">NO</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-4 col-12">
                <div class="form-group">
                    <strong>Persona juridica</strong>
                    <select name="per_juridica" class="form-control">
                        <option value="0">NO</option>
                        <option value="1">SI</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer p-0 d-block">
        <button type="button" class="btn btn-link text-tema" id="close_modal" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Salir</button>
        <button type="submit" class="btn btn-tema float-right">
            <span class="spinner-border spinner-border-sm mr-1" style="display: none;" id="loading-add-tipodocumento"></span>
            <i class="fa fa-save"></i> Guardar</button>
    </div>
</form>
