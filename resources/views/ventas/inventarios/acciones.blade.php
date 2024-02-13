<div class="dropdown">
    <button class="btn btn-outline-tema btn-sm btn-block dropdown-toggle" type="button" id="dropdownMenuButton"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-cogs"></i>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        @if($estado == 1)
            <a class="dropdown-item" href="javascript:void(0)"
                onclick="delete_confirm('{{ route('inventario.estado', $id) }}','Se eliminará el inventario!','eliminar','inventario')">Desactivar</a>
        @else
            <a class="dropdown-item" href="javascript:void(0)"
                onclick="delete_confirm('{{ route('inventario.estado', $id) }}','Se activará el inventario!','activar','inventario')">Activar</a>
        @endif
        <a class="dropdown-item" href="javascript:void(0)"
            onclick="modal_form('{{ route('inventario.edit', $id) }}')">Modificar</a>
    </div>
</div>
