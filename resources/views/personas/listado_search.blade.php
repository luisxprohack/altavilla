<div class="table-responsive">
    <table class="table table-bordered table-sm table-hover">
        <thead>
            <tr class="bg-secondary">
                <th>Documento</th>
                <th class="table-20">Datos</th>
                @if($tipo == 1)
                <th>Sucursal</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($persona as $item)
                <tr class="pointer" onclick="selected_persona('{{ $item->datos }}', {{ $item->id }})">
                    <td class="tsize-07">{{ $item->documento }}</td>
                    <td class="tsize-07">{{ $item->datos }}</td>
                    @if($tipo == 1)
                    <td class="tsize-07">{{ $item->sucursal }}</td>
                    @endif
                </tr>
            @empty
                <tr><td colspan="2"><span class="text-danger">No hay registros con el criterio de busqueda</span></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
    function selected_persona(data, id){
        $('#search_data_persona').val(data)
        $('#persona_value').val(id)
        $('#data_persona').css('display','none')
        $('#data_persona').html('')
    }
</script>
