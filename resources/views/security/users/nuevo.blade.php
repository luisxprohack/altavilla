<form action="{{ route('users.store') }}" method="POST" class="formentrada" id="add-user"
    onkeydown="return event.key != 'Enter';">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <strong>Datos de persona</strong>
                    @include('personas.search')
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <strong>Area</strong>
                    <select name="area" class="form-control form-control-sm"
                        onchange="getSelectedData('cargos','{{ url('cargos/cb') }}',value)">
                        <option value="0">[ SELECCIONE ]</option>
                        @foreach ($area as $item)
                            <option value="{{ $item->id }}">{{ $item->area }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <strong><span id="cargos_load"></span> Cargo<span class="text-danger">*</span></strong>
                    <select name="cargo" id="cb_cargos" class="form-control form-control-sm" required></select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <strong>Agencia</strong>
                    <select name="agencia" class="form-control form-control-sm" required>
                        @foreach ($agencia as $item)
                            <option value="{{ $item->id }}">{{ $item->agencia }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <strong>Usuario</strong>
                    <input type="text" name="usuario" class="form-control form-control-sm" autocomplete="off"
                        required>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <strong>Contraseña</strong>
                    <input type="password" name="password" class="form-control form-control-sm" required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <strong>Confirmar Contraseña</strong>
                    <input type="password" name="password_confirmation" class="form-control form-control-sm" required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <strong>E-mail</strong>
                    <input type="email" name="email" class="form-control form-control-sm" autocomplete="off"
                        required>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer p-0 d-block">
        <button type="button" class="btn text-tema" id="close_modal" data-dismiss="modal"><i
                class="fa fa-arrow-circle-left"></i> Salir</button>
        <button type="submit" class="btn btn-tema float-right">
            <span class="spinner-border spinner-border-sm mr-1" style="display: none;" id="loading-add-user"></span>
            <i class="fa fa-save"></i> Guardar</button>
    </div>
</form>
