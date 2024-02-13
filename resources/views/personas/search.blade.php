<div class="input-group">
    <div class="input-group-append">
        <select id="cb_persona" class="form-control form-control-sm">
            <option value="0">Datos</option>
            <option value="1">DNI/RUC</option>
        </select>
    </div>
    <input type="text" id="search_data_persona" class="form-control form-control-sm input-required" required
    @php
        $tipoBusqueda = isset($tipo) ? $tipo : 0; 
    @endphp
    onkeyup="search_data_json(value,'{{ route('personas.search', $tipoBusqueda) }}', 'data_persona', 'persona')" 
    autocomplete="off" placeholder="Buscando..."
    value="{{ isset($data) ? $data : '' }}">
    <div class="input-group-append">
        <button type="button" title="Registrar" class="btn btn-default btn-sm" 
            onclick="modal_form('{{ route('personas.create') }}','-super')"><i class="fa fa-user-plus text-tema"></i></button>
    </div>
</div> 
<input type="hidden" name="persona_value" id="persona_value" value="{{ isset($persona) ? $persona : 0 }}">
<div id="data_persona" class="search_data_json p-0"></div>

<script>
    $(document).on('click','#search_data_persona',function(){
        $('#search_data_persona').val('')
        $('#persona_value').val(0)
        $('#data_persona').css('display','none')
    })
</script>