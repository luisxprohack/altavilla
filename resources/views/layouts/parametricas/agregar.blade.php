<form action="{{ route('parametrizar.store') }}" method="POST" class="formentrada" id="add-register">
    @csrf
    <input type="hidden" name="table" value="{{ $table }}">
    <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <strong>Nombre de {{ substr($table, 0, -1) }}</strong>
                    <input type="text" name="nombre" class="form-control" autocomplete="off" required>
                </div>
            </div>
            <div class="col-sm-6 col-12">
                <div class="form-group">
                    <strong>Abreviatura</strong>
                    <input type="text" name="abreviatura" class="form-control" autocomplete="off">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer p-0 d-block">
        <button type="button" class="btn btn-link text-tema" id="close_modal" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Salir</button>
        <button type="submit" class="btn btn-tema float-right">
            <span class="spinner-border spinner-border-sm mr-1" style="display: none;" id="loading-add-register"></span>
            <i class="fa fa-save"></i> Guardar</button>
    </div>
</form>
