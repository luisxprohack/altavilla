<div class="modal-body">
    <form action="{{ route('search_user') }}" method="POST" id="selected-users" class="formsearch">
        @csrf
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <strong>Buscar por</strong>
                    <select name="tipo_busqueda" class="form-control form-control-sm">
                        <option value="1">Nro Documento</option>
                        <option value="2">Apelldos y Nombres</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <strong>&nbsp;</strong>
                    <div class="input-group mb-3">
                        <input type="text" name="dato_busqueda" class="form-control form-control-sm" maxlength="50"
                            autocomplete="off" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary btn-sm" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-12" id="search-selected-users"></div>
        <div class="col-12 text-right">
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
        </div>
    </div>
    </form>
</div>
<script>
    function selected_user(id, data){
        $('#user_value').val(id)
        $('#data_user').val(data)
        $('#modal-static-super').modal('hide')
    }
</script>
