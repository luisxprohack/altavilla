<form action="{{ route('personas.update',$persona->id) }}" method="POST" class="formentrada" id="add-persona" onkeydown="return event.key != 'Enter';">
    @csrf
    <input type="hidden" value="{{ $persona->id }}" id="persona_actual">
    
    <div class="modal-body pb-0">
        <div class="row">
            @include('personas.plantilla_data')
        </div>
    </div>

    <div class="modal-footer p-0 d-block">
        <button type="button" class="btn btn-link text-tema" id="close_modal" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Salir</button>
        <button type="submit" class="btn btn-tema float-right">
            <span class="spinner-border spinner-border-sm mr-1" style="display: none;" id="loading-add-persona"></span>
            <i class="fa fa-edit"></i> Modificar</button>
    </div>
</form>
