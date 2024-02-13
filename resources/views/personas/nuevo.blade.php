<!-- onkeydown="return event.key != 'Enter';" para que no se submit el enter -->

<form action="{{ route('personas.store') }}" method="POST" class="formentrada" id="add-persona" onkeydown="return event.key != 'Enter';">
    @csrf
    <div class="modal-body pb-0">
        <div class="row">
            @include('personas.plantilla_data')
        </div>
    </div>
    <div class="modal-footer p-0 d-block">
        <button type="button" class="btn btn-link text-tema" id="close_modal" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Salir</button>
        <button type="submit" class="btn btn-tema float-right">
            <span class="spinner-border spinner-border-sm mr-1" style="display: none;" id="loading-add-persona"></span>
            <i class="fa fa-save"></i> Guardar</button>
    </div>
</form>

<script>
    $('#collapseExample').on('shown.bs.collapse', function () {
        $('#envia_direccion').val(1)
    })
    $('#collapseExample').on('hidden.bs.collapse', function () {
        $('#envia_direccion').val(0)
    })

    function selected_tipopersona(value){
        //Obtener los tipo documentos
        getSelectedData('tipodocumento',"{{ url('getTipoDocumentos') }}",value,1)

        $('.tipopersona').css('display', 'none')
        if (value == 1){
            $('#personanatural').css('display', 'block')
        }else{
            $('#personajuridica').css('display', 'block')
        }
    }
</script>
