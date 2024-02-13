<form action="{{ route('personas.direccion.update', $direccion->id) }}" method="POST" class="formentrada" id="add-direccion">
    @csrf
    <div class="modal-body">
        <div class="row">
            @include('personas.direcciones.plantillaUbigeo')
        </div>

    </div>
    <div class="modal-footer p-0 d-block">
        <button type="button" class="btn btn-link text-tema" data-dismiss="modal" id="close_modal"><i class="fa fa-arrow-circle-left"></i> Salir</button>
        <button type="button" class="btn btn-tema float-right" onclick="selected_direccion()">
            <span class="spinner-border spinner-border-sm mr-1" style="display: none;" id="loading-add-direccion"></span>
            <i class="fa fa-edit"></i> Modificar</button>
    </div>
</form>