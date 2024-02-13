
<form action="{{ route('users.permission', $user->id) }}" method="POST" class="formentrada" id="add_permission_especial">
    @csrf
    <div class="modal-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <tbody id="content-permisos-especiales">
                    @foreach($permissions as $per)
                    <tr>
                        <td class="p-0"><label><input type="checkbox" style="height: 18px; width: 32px;"
                                        name="permisos_especial[]"
                                        value="{{ $per->name }}"
                                        {{ $user->hasPermissionTo($per->name) ? 'checked' : '' }}
                                        >{{ $per->name }}</label></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer p-0 d-block">
        <button type="button" class="btn text-tema" id="close_modal" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Salir</button>
        <button type="submit" class="btn btn-tema float-right">
            <span class="spinner-border spinner-border-sm mr-1" style="display: none;" id="loading-add_permission_especial"></span>
            <i class="fa fa-save"></i> Guardar</button>
    </div>
</form>
