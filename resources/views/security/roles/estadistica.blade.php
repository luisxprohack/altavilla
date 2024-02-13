@php $c = 0 @endphp
@foreach(\DB::table('estadisticas')->where('role_id', $id)->get() as $item)
    <span class="badge badge-secondary">
        @switch($item->estadistica)
            @case(1)
                Hospedaje
                @break
            @case(2)
                Administrativo
                @break
            @case(3)
                Gráficos
                @break
        @endswitch
    </span>
    @php $c++; @endphp
@endforeach
@if($c > 0) <br> @endif
<button class="btn btn-outline-secondary btn-xs" onclick="modal_form('{{ route('roles.estadistica', $id) }}')">Agregar ó Quitar</button>
