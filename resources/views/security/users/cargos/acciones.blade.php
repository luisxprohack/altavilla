<div class="dropdown">
    <button class="btn btn-outline-tema btn-sm btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fa fa-cogs"></i>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		<a class="dropdown-item" href="javascript:void(0)" onclick="modal_form('{{ route('cargos.edit', $id) }}')">Modificar</a>
		<a class="dropdown-item" href="javascript:void(0)" onclick="delete_confirm('{{ route('cargos.delete', $id) }}','Se eliminará el cargo!','eliminar','cargos')">Eliminar</a>
    </div>
</div>