<div class="pb-3 mt-3 mb-3 user-panel d-flex">
    <div class="image">
        <img src="{{ asset('img/' . $user->avatar) }}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
        @php
            $persona = $user->persona->personanatural;
        @endphp
        <span class="d-block tsize-08">{{ $persona->nombres }} {{ $persona->apaterno }} {{ $persona->amaterno }}</span>
        <span class='tsize-08'>{{ ucwords(strtolower($user->cargo->cargo)) }}</span>
    </div>
</div>
<nav class="mt-n2">
    <!-- nav-flat -->

    <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu" data-accordion="true">
        @can('personas')
            <li class="mt-3 nav-item has-treeview">
                <a href="#" class="pl-1 nav-link">
                    <i class="fa fa-users nav-icon"></i>
                    <p> Personas <i class="right fas fa-angle-left"></i> </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="javascript:void(0)" onclick="dataview('{{ route('personas') }}','content-lst')"
                            class="pl-2 nav-link nav-item-two">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>Listado</p>
                        </a>
                    </li>
                    @can('personas.tipo_personas')
                        <li class="nav-item">
                            <a href="javascript:void(0)"
                                onclick="dataview('{{ url('parametrizars/tipopersonas') }}','content-lst')"
                                class="pl-2 nav-link nav-item-two">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Tipo personas</p>
                            </a>
                        </li>
                    @endcan
                    @can('personas.tipo_documentos')
                        <li class="nav-item">
                            <a href="javascript:void(0)" onclick="dataview('{{ route('tipodocumentos') }}','content-lst')"
                                class="pl-2 nav-link nav-item-two">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Tipo documentos</p>
                            </a>
                        </li>
                    @endcan
                    @can('personas.estado_civil')
                        <li class="nav-item">
                            <a href="javascript:void(0)"
                                onclick="dataview('{{ url('parametrizars/estadocivils') }}','content-lst')"
                                class="pl-2 nav-link nav-item-two">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Estado civil</p>
                            </a>
                        </li>
                    @endcan
                    @can('personas.ocupacion')
                        <li class="nav-item">
                            <a href="javascript:void(0)"
                                onclick="dataview('{{ url('parametrizars/ocupacions') }}','content-lst')"
                                class="pl-2 nav-link nav-item-two">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Ocupacion</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('seguridad')
            <li class="nav-item has-treeview">
                <a href="#" class="pl-1 nav-link">
                    <i class="fa fa-lock nav-icon"></i>
                    <p> Seguridad <i class="right fas fa-angle-left"></i> </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('seguridad.perfiles')
                        <li class="nav-item has-treeview">
                            <a href="#" class="pl-2 nav-link">
                                <i class="fa fa-cubes nav-icon"></i>
                                <p>
                                    Perfiles
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="javascript:void(0)" onclick="dataview('{{ route('roles') }}','content-lst')"
                                        class="pl-3 nav-link nav-item-two">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Listado de Perfiles</p>
                                    </a>
                                </li>
                                @can('seguridad.perfiles.permisos')
                                    <li class="nav-item">
                                        <a href="javascript:void(0)"
                                            onclick="dataview('{{ route('permissions.list') }}','content-lst')"
                                            class="pl-3 nav-link nav-item-two">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Listado de Permisos</p>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan

                    @can('seguridad.usuarios')
                        <li class="nav-item has-treeview">
                            <a href="#" class="pl-2 nav-link">
                                <i class="fa fa-user-circle nav-icon"></i>
                                <p>
                                    Usuarios
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('seguridad.usuarios.listado')
                                    <li class="nav-item">
                                        <a href="javascript:void(0)" onclick="dataview('{{ route('users') }}','content-lst')"
                                            class="pl-3 nav-link nav-item-two">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Listado de Usuarios</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('seguridad.usuarios.cargos')
                                    <li class="nav-item">
                                        <a href="javascript:void(0)" onclick="dataview('{{ route('cargos') }}','content-lst')"
                                            class="pl-3 nav-link nav-item-two">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Cargos</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('seguridad.usuarios.areas')
                                    <li class="nav-item">
                                        <a href="javascript:void(0)"
                                            onclick="dataview('{{ url('parametrizars/areas') }}','content-lst')"
                                            class="pl-3 nav-link nav-item-two">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Areas</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('seguridad.usuarios.agencia')
                                    <li class="nav-item">
                                        <a href="javascript:void(0)" onclick="dataview('{{ route('agencia') }}','content-lst')"
                                            class="pl-3 nav-link nav-item-two">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Agencia</p>
                                        </a>
                                    </li>
                                @endcan

                                @can('seguridad.usuarios.asignar_perfil')
                                    <li class="nav-item">
                                        <a href="javascript:void(0)" onclick="dataview('{{ route('users.roles') }}','content-lst')"
                                            class="pl-3 nav-link nav-item-two">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Asignar perfiles</p>
                                        </a>
                                    </li>
                                @endcan

                            </ul>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        <li class="nav-item has-treeview">
            <a href="#" class="pl-1 nav-link">
                <i class="fa fa-shopping-cart nav-icon"></i>
                <p> Ventas <i class="right fas fa-angle-left"></i> </p>
            </a>
            <ul class="nav nav-treeview">
                <!-- Opciones del módulo de Ventas -->
                <li class="nav-item">
                    <a href="#" class="pl-2 nav-link nav-item-two">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Registrar Venta</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="pl-2 nav-link nav-item-two">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Historial de Ventas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="pl-2 nav-link nav-item-two">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Clientes</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0)" onclick="dataview('{{ route('inventario') }}','content-lst')" class="pl-2 nav-link nav-item-two">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Productos</p>
                    </a>
                </li>
                <!-- Agrega más opciones según las necesidades del módulo de Ventas -->
            </ul>
        </li>
    </ul>
</nav>
