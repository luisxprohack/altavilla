<form action="{{ route('users.roles.asignar', $user->id) }}" method="POST" class="formentrada" id="add-user-rol">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-warning">
                    Se esta asignando perfiles al usuario <strong>{{ $user->persona->datos }}</strong>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <strong>Seleccionar PERFIL</strong>
                    <select name="role" class='form-control'>
                        @foreach($roles as $item)
                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer p-0 d-block">
        <button type="button" class="btn text-tema" id="close_modal" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Salir</button>
        <button type="submit" class="btn btn-tema float-right">
            <span class="spinner-border spinner-border-sm mr-1" style="display: none;" id="loading-add-user-rol"></span>
            <i class="fa fa-save"></i> Guardar</button>
    </div>
</form>

