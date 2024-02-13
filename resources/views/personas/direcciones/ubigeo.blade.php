<div class="col-sm-4">
    <div class="form-group">
        <strong>Departamento<span class="text-danger">*</span></strong>
        <select name="departamento" id="cb_departamento" class="form-control form-control-sm" onchange="getSelectedData('provincia','{{ url('ubigeo') }}',value)">
            <option value="0">[ SELECCIONE ]</option>
            @php
                $departamento = 173;
                if(isset($agencia)){
                    $departamento = $ubigeo->idDpto;
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
            @if(isset($agencia))
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
        <select name="distrito" id="cb_distrito" class="form-control form-control-sm">
            @if(isset($agencia))
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
        <input type="text" class="form-control form-control-sm" value="{{ isset($agencia) ? $agencia->direccion : '' }}" name="direccion" id="direccion">
    </div>
</div>