<form action="{{ route('cargos.store') }}" method="POST" class="formentrada" id="add-cargo">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <strong>Area</strong>
                    <select name="area" class="form-control form-control-sm">
                        @foreach($area as $item)
                            <option value="{{ $item->id }}">{{ $item->area }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <strong>Nombre del cargo</strong>
                    <input type="text" name="cargo" class="form-control form-control-sm" autocomplete="off" required>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer p-0 d-block">
        <button type="button" class="btn btn-link text-tema" id="close_modal" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Salir</button>
        <button type="submit" class="btn btn-tema float-right">
            <span class="spinner-border spinner-border-sm mr-1" style="display: none;" id="loading-add-cargo"></span>
            <i class="fa fa-save"></i> Guardar</button>
    </div>
</form>