<div class="dropdown">
    <button class="btn btn-outline-tema btn-sm btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fa fa-cogs"></i>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        @can('seguridad.perfiles.asignar_permisos')
        <a class="dropdown-item" href="javascript:void(0)" onclick="modal_form('{{ route('roles.permission', $id) }}')">Asignar permisos</a>    
        @endcan
        @can('seguridad.perfiles.modificar')
        <a class="dropdown-item" href="javascript:void(0)" onclick="modal_form('{{ route('roles.edit', $id) }}')">Editar</a>
        @endcan
        @can('seguridad.perfiles.eliminar')
        <a href="javascript:void(0)" class="dropdown-item"
            onclick="delete_confirm('{{ route('roles.delete', $id) }}','Se eliminará perfil!','eliminar','roles')">
            Eliminar</a>
        @endcan
    </div>
</div>
