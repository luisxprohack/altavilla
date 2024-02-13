<form action="{{ route('permissions.store') }}" method="POST" class="formentrada" id="add-permission">
    @csrf
    @php $array = explode('.',$name); @endphp
    <div class="modal-body">
        <div class="row">
            @if($array[0] != '')
                <div class="col-12">
                    <div class="form-group">
                        <b>Jerarquia</b>
                        @for($i=0; $i<count($array); $i++)
                            <input type='text' value='{{ $array[$i] }}' disabled class="form-control form-control-sm">
                        @endfor
                    </div>
                </div>
            @endif
            <div class="col-12">
                <div class="form-group">
                    <strong>Nombre del permiso</strong>
                    <input type="text" name="nombre" class="form-control form-control-sm" autocomplete="off" required>
                </div>
            </div>
            <input type="hidden" name="jerarquia" value="{{ $name }}">
        </div>
    </div>
    <div class="modal-footer p-0 d-block">
        <button type="button" class="btn text-tema" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Salir</button>
        <button type="submit" class="btn btn-tema float-right">
            <span class="spinner-border spinner-border-sm mr-1" style="display: none;" id="loading-add-permission"></span>
            <i class="fa fa-save"></i> Guardar</button>
    </div>
</form>

