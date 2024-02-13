

<div class="dropdown">
    <button class="btn btn-outline-tema btn-sm btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fa fa-cogs"></i>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item" href="javascript:void(0)" onclick="modal_form('{{ route('users.show', $id) }}')">Ver información</a>
      @can('seguridad.usuarios.listado.modificar')
      <a class="dropdown-item" href="javascript:void(0)" onclick="modal_form('{{ route('users.edit', $id) }}')">Modificar</a>
      @endcan
      @can('seguridad.usuarios.listado.permisos_especiales')
      <a class="dropdown-item" href="javascript:void(0)" onclick="modal_form('{{ route('users.permission', $id) }}')">Permisos especiales</a>
      @endcan
    @can('seguridad.usuarios.listado.deshabilitar')
        @if($estado)
            <a href="javascript:void(0)" class="dropdown-item"
            onclick="delete_confirm('{{ route('users.active', [$id,0]) }}','Esta acción deshabilitará, eliminará los Perfiles y Permisos Especiales del usuario!','deshabilitar','users')">
            Deshabilitar</a>
        @else
            <a href="javascript:void(0)" class="dropdown-item"
            onclick="delete_confirm('{{ route('users.active', [$id,1]) }}','Se habilitará el acceso del usuario al sistema!','habilitar','users')">
            Habilitar</a>
        @endif
    @endcan
    </div>
</div>
