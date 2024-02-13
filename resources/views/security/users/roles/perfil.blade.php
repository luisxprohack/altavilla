@foreach($listadoPerfiles as $roles)
    <span class="badge btn-tema mr-2" id="del-{{ $roles->id }}"><b style="font-size: 0.8rem;">{{ $roles->name }}
        <i title="Eliminar" class="fa fa-times fa-lg text-danger pointer"onclick="delete_confirm('{{ route('users.roles.delete', [$id,$roles->id] ) }}','Se eliminará el rol!','eliminar','del-{{ $roles->id }}',1)"></i></b>
    </span>
@endforeach
