<link href="{{ asset('css/treeview/hummingbird-treeview.css') }}" rel="stylesheet">
<form action="{{ route('roles.permission', $role) }}" method="POST" class="formentrada" id="assing-permission">
    @csrf
    <div class="modal-body">
    <div class="row">
        <div class="col-12">
            <ul id="treeview" class="hummingbird-treeview">
                @php $spatie = new \App\Models\SpatieEAB(); @endphp
            @foreach($permissions as $item)
                @php $array = explode('.',$item['name']); @endphp
                @if(count($array) == 1)
                <li>@if($spatie->getPermission($item['name']))<i class="fa fa-plus"></i> @endif
                    <label> <input type="checkbox" name="p{{ $item['id'] }}"
                        @if($spatie->getPermissionRole($role,$item['id'])) checked @endif> {{ $array[0] }}</label>
                    <ul>
                        @foreach($permissions as $item2)
                            @php $array2 = explode('.',$item2['name']); @endphp
                            @if(count($array2) == 2 && $array[0] == $array2[0])
                                <li>@if($spatie->getPermission($item2['name']))<i class="fa fa-plus"></i>  @endif
                                    <label> <input type="checkbox" name="p{{ $item2['id'] }}"
                                        @if($spatie->getPermissionRole($role,$item2['id'])) checked @endif> {{ $array2[1] }}</label>
                                    <ul>
                                    @foreach($permissions as $item3)
                                        @php $array3 = explode('.',$item3['name']); @endphp
                                        @if(count($array3) == 3 && $array2[0].'.'.$array2[1] == $array3[0].'.'.$array3[1])
                                            <li>@if($spatie->getPermission($item3['name']))<i class="fa fa-plus"></i>  @endif
                                                <label><input class="hummingbirdNoParent" type="checkbox" name="p{{ $item3['id'] }}"
                                                    @if($spatie->getPermissionRole($role,$item3['id'])) checked @endif>  {{ $array3[2] }}</label>
                                                <ul>
                                                    @foreach($permissions as $item4)
                                                        @php $array4 = explode('.',$item4['name']); @endphp
                                                        @if(count($array4) == 4 && $array3[1].'.'.$array3[2] == $array4[1].'.'.$array4[2])
                                                            <li><label><input class="hummingbirdNoParent" type="checkbox" name="p{{ $item4['id'] }}"
                                                                @if($spatie->getPermissionRole($role,$item4['id'])) checked @endif>  {{ $array4[3] }}</label>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
                @endif
            @endforeach
            </ul>
        </div>
    </div>
    </div>
    <div class="modal-footer p-0 d-block">
        <button type="button" class="btn text-tema" id="close_modal" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Salir</button>
        <button type="submit" class="btn btn-tema float-right">
            <span class="spinner-border spinner-border-sm mr-1" style="display: none;" id="loading-assing-permission"></span>
            <i class="fa fa-save"></i> Guardar</button>
    </div>
</form>

<script src="{{ asset('css/treeview/hummingbird-treeview.js') }}"></script>
<script>
    $("#treeview").hummingbird();
</script>
