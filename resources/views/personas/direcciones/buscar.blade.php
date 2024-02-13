@foreach($direccion as $item)
<tr id="direccion-{{ $item->id }}">
    <td class="text-center p-0">
        <div class="dropdown">
            <button class="btn btn-default btn-sm btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-cogs"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="javascript:void(0)" onclick="modal_form('{{ route('personas.direccion.edit', $item->id) }}','-super')">Modificar</a>
                <a class="dropdown-item" href="javascript:void(0)" onclick="delete_confirm('{{ route('personas.direccion.delete', $item->id) }}','Se eliminará la direccion!','eliminar','direccion-{{ $item->id }}',1)">Eliminar</a>
            </div>
        </div>
    </td>
    
    <td>{!! $item->principal == 1 ? "<i title='Dirección principal' class='fa fa-check text-primary'></i>" : '' !!} {{ $item->direccion }}</td>
    <td>{{ $item->tipodireccion->tipodireccion }}</td>
    @php
        $ubigeo = $item->getUbigeo();
    @endphp
    <td>{{ $ubigeo->loc }}</td>
    <td>{{ $ubigeo->dist }}</td>
    <td>{{ $ubigeo->prov }}</td>
    <td>{{ $ubigeo->dpto }}</td>
    <td>{{ $item->referencia }}</td>
</tr>
@endforeach