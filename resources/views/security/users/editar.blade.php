<form action="{{ route('users.update', $user->id) }}" method="POST" class="formentrada" id="add-user">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <p><b><i class="fa fa-user-check"></i> {{ $user->persona->datos }}</b></p>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <strong>Area</strong>
                    <select name="area" class="form-control form-control-sm"  onchange="getSelectedData('cargos','{{ url('cargos/cb') }}',value)">
                        <option value="0">[ SELECCIONE ]</option>
                        @foreach($area as $item)
                            <option value="{{ $item->id }}" {{ $user->cargo->area_id == $item->id ? 'selected' : '' }}> 
                                    {{ $item->area }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <strong><span id="cargos_load"></span> Cargo<span class="text-danger">*</span></strong>
                    <select name="cargo" id="cb_cargos" class="form-control form-control-sm">
                        @foreach ($cargos as $item)
                            <option value="{{ $item->id }}" {{ $user->cargo_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->cargo }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <strong>Agencia</strong>
                    <select name="agencia" class="form-control form-control-sm">
                        @foreach ($agencia as $item)
                            <option value="{{ $item->id }}" {{ $user->agencia_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->agencia }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <strong>Usuario</strong>
                    <input type="text" name="usuario" value="{{ $user->username }}" class="form-control form-control-sm" autocomplete="off">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <strong>Password</strong>
                    <input type="password" name="password" class="form-control form-control-sm" placeholder="No es obligatorio">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <strong>Confirmar Password</strong>
                    <input type="password" name="password_confirmation" class="form-control form-control-sm" placeholder="No es obligatorio">
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <strong>E-mail</strong>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control form-control-sm" autocomplete="off">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer p-0 d-block">
        <button type="button" class="btn text-tema" id="close_modal" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Salir</button>
        <button type="submit" class="btn btn-tema float-right">
            <span class="spinner-border spinner-border-sm mr-1" style="display: none;" id="loading-add-user"></span>
            <i class="fa fa-edit"></i> Modificar</button>
    </div>
</form>
