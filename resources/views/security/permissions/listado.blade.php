
<link href="{{ asset('css/treeview/hummingbird-treeview.css') }}" rel="stylesheet">
<div class="col-12">
    <div class="card card-outline card-tema">
        <div class="card-header p-2">             
            <strong class="title-lst tsize-2"> Mantenimiento de permisos</strong>
            <button id="btnpermission" style="display: none;" onclick="dataview('{{ route('permissions.list') }}','dataSearch','POST')"></button>
        </div>
        <div class="card-body p-2 ">
            <div class="card-body p-2" id="dataSearch">
                <ul id="treeview" class="hummingbird-treeview">
                    @foreach($permissions as $item)
                        @php $array = explode('.',$item['name']); @endphp
                        @if(count($array) == 1)
                        <li id="del-{{ $item['id'] }}"><i class="fa fa-plus"></i>
                            <label>
                                <i class="fa fa-edit text-info" onclick="modal_form('{{ route('permissions.edit', $item['id']) }}')"></i>
                            <i class="fa fa-trash-alt text-danger mr-2" onclick="delete_confirm('{{ route('permissions.delete', $item['id']) }}','Se eliminará el permiso!','eliminar','del-{{ $item['id'] }}',1)"></i>
                                {{ $array[0] }}</label>
                            <ul style="display: none;">
                                @foreach($permissions as $item2)
                                    @php $array2 = explode('.',$item2['name']); @endphp
                                    @if(count($array2) == 2 && $array[0] == $array2[0])
                                    <li id="del-{{ $item2['id'] }}"><i class="fa fa-plus"></i>
                                            <label>
                                                <i class="fa fa-edit text-info" onclick="modal_form('{{ route('permissions.edit', $item2['id']) }}')"></i>
                                            <i class="fa fa-trash-alt text-danger mr-2" onclick="delete_confirm('{{ route('permissions.delete', $item2['id']) }}','Se eliminará el permiso!','eliminar','del-{{ $item2['id'] }}',1)"></i>
                                                {{ $array2[1] }}
                                            </label>
                                            <ul>
                                            @foreach($permissions as $item3)
                                                @php $array3 = explode('.',$item3['name']); @endphp
                                                @if(count($array3) == 3 && $array2[0].'.'.$array2[1] == $array3[0].'.'.$array3[1])
                                                    <li id="del-{{ $item3['id'] }}"><i class="fa fa-plus"></i>
                                                        <label>
                                                            <i class="fa fa-edit text-info" onclick="modal_form('{{ route('permissions.edit', $item3['id']) }}')"></i>
                                                        <i class="fa fa-trash-alt text-danger mr-2" onclick="delete_confirm('{{ route('permissions.delete', $item3['id']) }}','Se eliminará el permiso!','eliminar','del-{{ $item3['id'] }}',1)"></i>
                                                            {{ $array3[2] }}</label>
                                                            <ul>
                                                                @foreach($permissions as $item4)
                                                                    @php $array4 = explode('.',$item4['name']); @endphp
                                                                    @if(count($array4) == 4 && $array3[1].'.'.$array3[2] == $array4[1].'.'.$array4[2])
                                                                        <li id="del-{{ $item4['id'] }}"><label>
                                                                            <i class="fa fa-edit text-info" onclick="modal_form('{{ route('permissions.edit', $item4['id']) }}')"></i>
                                                                        <i class="fa fa-trash-alt text-danger mr-2" onclick="delete_confirm('{{ route('permissions.delete', $item4['id']) }}','Se eliminará el permiso!','eliminar','del-{{ $item4['id'] }}',1)"></i>
                                                                            {{ $array4[3] }}</label>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                                <li><button type="button" class="btn btn-secondary btn-sm ml-1 mb-2" onclick="modal_form('{{ route('permissions.create', $item3['name'] ) }}')"><i class="fa fa-plus-circle"></i> Agregar permiso</button></li>
                                                            </ul>
                                                    </li>
                                                @endif
                                            @endforeach
                                            <li><button type="button" class="btn btn-secondary btn-sm ml-1 mb-2" onclick="modal_form('{{ route('permissions.create', $item2['name'] ) }}')"><i class="fa fa-plus-circle"></i> Agregar permiso</button></li>
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach
                                <li><button type="button" class="btn btn-secondary btn-sm ml-1 mb-2" onclick="modal_form('{{ route('permissions.create', $item['name'] ) }}')"><i class="fa fa-plus-circle"></i> Agregar permiso</button></li>
                            </ul>
                        </li>
                        @endif
                    @endforeach
                    <li><button type="button" class="btn btn-secondary btn-sm ml-1 mb-2" onclick="modal_form('{{ route('permissions.create') }}')"><i class="fa fa-plus-circle"></i> Agregar permiso</button></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('css/treeview/hummingbird-treeview.js') }}"></script>

<script>
    $("#treeview").hummingbird();
</script>
