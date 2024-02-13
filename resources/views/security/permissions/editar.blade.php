@php
    
    $perArray = explode('.',$permission->name);
    $namePermiso = $perArray[count($perArray)-1];

    $namePermisoCompleto = Str::replace($namePermiso, '', $permission->name);

@endphp

<form action="{{ route('permissions.update', $permission->id) }}" method="POST" class="formentrada" id="add-permission">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <strong>Permiso</strong>                    
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">{{ $namePermisoCompleto }}</span>
                        </div>
                        <input type="text" name="nombre" class="form-control" value="{{ $namePermiso }}" aria-describedby="basic-addon1">
                        <input type="hidden" value="{{ $namePermisoCompleto }}" name="nombreCompleto">
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer p-0 d-block">
        <button type="button" class="btn text-tema" id="close_modal" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Salir</button>
        <button type="submit" class="btn btn-tema float-right">
            <span class="spinner-border spinner-border-sm mr-1" style="display: none;" id="loading-add-permission"></span>
            <i class="fa fa-edit"></i> Modificar</button>
    </div>
</form>
