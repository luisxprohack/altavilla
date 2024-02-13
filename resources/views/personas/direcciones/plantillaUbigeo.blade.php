<div class="col-sm-4">
    <div class="form-group">
        <strong>Departamento<span class="text-danger">*</span></strong>
        <select name="departamento" id="cb_departamento" class="form-control form-control-sm" onchange="getSelectedData('provincia','{{ url('ubigeo') }}',value)">
           <option value="0">[ SELECCIONE ]</option>
           @php
                $departamento = 173;
                $tipodireccion = 0;
                if(isset($direccion)){
                    $departamento = $ubigeo->idDpto;
                    $tipodireccion = $direccion->tipodireccion_id;
                }
            @endphp
            @foreach (departamentos() as $dpto)
                <option value="{{ $dpto->id }}" {{ $dpto->id == $departamento ? 'selected' : '' }}>{{ $dpto->ubigeo }}</option>
            @endforeach          
        </select>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group">
        <strong><span id="provincia_load"></span> Provincia<span class="text-danger">*</span></strong>
        <select name="provincia" id="cb_provincia" class="form-control form-control-sm" onchange="getSelectedData('distrito','{{ url('ubigeo') }}',value,1)">
            @if(isset($direccion))
                @foreach ($provincias as $prov)
                <option value="{{ $prov->id }}" {{ $prov->id == $ubigeo->idProv ? 'selected' : '' }}>{{ $prov->ubigeo }}</option>
                @endforeach
            @endif
    </select>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group">
        <strong><span id="distrito_load"></span> Distrito<span class="text-danger">*</span></strong>
        <select name="distrito" id="cb_distrito" class="form-control form-control-sm" >
            @if(isset($direccion))
                @foreach ($distritos as $dist)
                    <option value="{{ $dist->id }}" {{ $dist->id == $ubigeo->idDist ? 'selected' : '' }}>{{ $dist->ubigeo }}</option>
                @endforeach               
            @endif     
        </select>
    </div>
</div>
<div class="col-12">
    <div class="form-group">
        <strong>Dirección<span class="text-danger">*</span></strong>
        <input type="text" class="form-control form-control-sm" value="{{ isset($direccion) ? $direccion->direccion : '' }}" name="direccion" id="direccion">
    </div>
</div>
<div class="col-8">
    <div class="form-group">
        <strong>Referencia</strong>
        <input type="text" class="form-control form-control-sm" value="{{ isset($direccion) ? $direccion->referencia : '' }}" name="referencia">
    </div>
</div>
<div class="col-4">
    <div class="form-group">
        <strong>Tipo Dirección</strong>
        <select name="tipodireccion" class="form-control form-control-sm">
            @foreach(tipodireccion() as $item)
                <option value="{{ $item->id }}" {{ $item->id == $tipodireccion ? 'selected' : '' }}>{{ $item->tipodireccion }}</option>
            @endforeach
        </select>
    </div>
</div>

<label class="pl-2">
    @if(isset($direccion))
        @if(!$direccion->principal) <input type="checkbox" name="direccion_principal"> Direccion principal? @endif
    @else
        <input type="checkbox" name="direccion_principal"> Direccion principal?
    @endif
</label>

<script type="text/javascript">
    function selected_direccion()
    {
        let valida = 0
        if ($('#distrito').val() === null){ $('#distrito').addClass('is-invalid'); valida=1;
        }else { $('#distrito').removeClass('is-invalid') }
        if ($('#direccion').val() === ''){ $('#direccion').addClass('is-invalid'); valida = 1;
        }else{ $('#direccion').removeClass('is-invalid') }
        if(valida === 1) { return }

        $('#persona_direccion').val($('#persona_actual').val())
        $('#add-direccion').submit()
    }
</script>