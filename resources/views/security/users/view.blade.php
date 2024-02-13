    <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header p-1 bg-light"><strong>Información general</strong></div>
                    <div class="card-body p-1">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <tr>
                                    <td class="table-100 text-right bg-light"><b>DNI</b></td>
                                    <td>{{ $user->persona->documento }}</td>
                                </tr>
                                <tr>
                                    <td class="table-100 text-right bg-light"><b>DATOS</b></td>
                                    <td>{{ $user->persona->datos }}</td>
                                </tr>
                                <tr>
                                    <td class="table-100 text-right bg-light"><b>AREA</b></td>
                                    <td>{{ $user->cargo->area->area }}</td>
                                </tr>
                                <tr>
                                    <td class="table-100 text-right bg-light"><b>CARGO</b></td>
                                    <td>{{ $user->cargo->cargo }}</td>
                                </tr>
                                <tr>
                                    <td class="table-100 text-right bg-light"><b>USUARIO</b></td>
                                    <td>{{ $user->username }}</td>
                                </tr>
                                <tr>
                                    <td class="table-100 text-right bg-light"><b>AGENCIA</b></td>
                                    <td>{{ $user->agencia->agencia }}</td>
                                </tr>
                                <tr>
                                    <td class="table-100 text-right bg-light"><b>E-MAIL</b></td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td class="table-100 text-right bg-light"><b>TELEFONO</b></td>
                                    <td>{{ $user->persona->telefono }}</td>
                                </tr>
                                <tr>
                                    <td class="table-100 text-right bg-light"><b>ESTADO</b></td>
                                    <td><span class="badge badge-{{ $user->estado ? 'success' : 'danger' }}">
                                        {{ $user->estado ? 'Activo' : 'Deshabilitado' }}</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header p-1 bg-light"><strong>Roles</strong></div>
                    <div class="card-body">
                        @foreach($user->getRole() as $role)
                            <span class="badge badge-primary p-1">{{ $role->name }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header p-1 bg-light"><strong>Permisos especiales</strong></div>
                    <div class="card-body">
                        @foreach($user->getPermissionNames() as $permission)
                            <span class="badge badge-success">{{ $permission }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer p-0">
        <button type="button" class="btn btn-tema btn-sm" id="close_modal" data-dismiss="modal">Cerrar</button>
    </div>
