<div class="dropdown">
    <button class="btn btn-outline-tema btn-sm btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fa fa-cogs"></i>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    	@can('personas.listado.modificar')
    		<a class="dropdown-item" href="javascript:void(0)" onclick="modal_form('{{ route('personas.edit', $id) }}','-lg')">Modificar</a>
    	@endcan
     	@can('personas.listado.eliminar')
		    @if($estado)
		        <a class="dropdown-item" href="javascript:void(0)" onclick="delete_confirm('{{ route('personas.active', [$id,0]) }}','Se eliminará la persona!','eliminar','personas')">Eliminar</a>
		    @else
		    	<a class="dropdown-item" href="javascript:void(0)" onclick="delete_confirm('{{ route('personas.active', [$id,1]) }}','Se activará la persona!','activar','personas')">Activar</a>
			@endif
		@endcan
    </div>
</div>