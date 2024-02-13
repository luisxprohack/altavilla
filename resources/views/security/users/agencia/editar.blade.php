<form action="{{ route('agencia.update', $agencia->id) }}" method="POST" class="formentrada" id="up-agencia">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <strong>Nombre de Agencia</strong>
                    <input type="text" name="agencia" value="{{ $agencia->agencia }}"
                        class="form-control form-control-sm" autocomplete="off" required>
                </div>
            </div>
            <div class="col-sm-6 col-12">
                <div class="form-group">
                    <strong>Nombre Corto</strong>
                    <input type="text" name="nombre_corto" value="{{ $agencia->nombre_corto }}"
                        class="form-control form-control-sm" autocomplete="off" required>
                </div>
            </div>
            <div class="col-sm-6 col-12">
                <div class="form-group">
                    <strong>Telefono</strong>
                    <input type="text" name="telefono" value="{{ $agencia->telefono }}"
                        class="form-control form-control-sm" autocomplete="off">
                </div>
            </div>

            @include('personas.direcciones.ubigeo')
        </div>
    </div>
    <div class="modal-footer p-0 d-block">
        <button type="button" class="btn btn-link text-tema" id="close_modal" data-dismiss="modal"><i
                class="fa fa-arrow-circle-left"></i> Salir</button>
        <button type="submit" class="btn btn-tema float-right">
            <span class="spinner-border spinner-border-sm mr-1" style="display: none;" id="loading-up-agencia"></span>
            <i class="fa fa-save"></i> Modificar</button>
    </div>
</form>
