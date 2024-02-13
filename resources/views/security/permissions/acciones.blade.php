<a href="javascript:void(0)" class="btn btn-success btn-xs" title="Editar" onclick="modal_form('{{ route('permissions.edit', $id) }}')"><i class="fa fa-edit"></i></a>
<a href="javascript:void(0)" class="btn btn-danger btn-xs" onclick="delete_confirm('{{ route('permissions.delete', $id) }}','Se eliminará el permiso!','eliminar','roles')" title="Eliminar">
    <i class="fa fa-trash-alt"></i></a>

