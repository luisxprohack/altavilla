    
<div class="col-sm-4">
    <div class="form-group">
        <strong>Tipo persona</strong>
        <select name="tipopersona" class="form-control form-control-sm" 
            @if(isset($persona)) 
                disabled
            @else 
                onchange="selected_tipopersona(value)"
            @endif
            >
            @foreach(tipopersona() as $item)
                <option value="{{ $item->id }}" 
                    {{ isset($persona) && $persona->tipopersona_id == $item->id ? 'selected' : '' }} >
                    {{ $item->tipopersona }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group">
        <span id="tipodocumento_load"></span>
        <strong>Tipo documento</strong>                
        <select name="tipodocumento" id="cb_tipodocumento" {{ isset($persona) ? 'disabled' : '' }} 
            class="form-control form-control-sm">
            @foreach(tipodocumento(isset($persona) ? $persona->tipopersona_id : 1) as $item)
                <option value="{{ $item->id }}" 
                    {{ isset($persona) && $persona->tipodocumento_id == $item->id ? 'selected' : '' }}>
                    {{ $item->nombre_corto }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group">
        <strong>Documento</strong>
        <span class="float-right alert-search-dni"></span>
        <input type="text" name="documento" id="documento" value="{{ isset($persona) ? $persona->documento : '' }}" 
           @if(isset($persona)) @unlessrole('admin') disabled @endunlessrole @endif
           class="form-control form-control-sm input-required" autocomplete="off" required onkeyup="if(event.keyCode == 13) getDataPersona(value) ">
    </div>
</div>
<div class="col-sm-8 col-12">
    <div class="row">
        <div class="col-12">
            <div class="card tipopersona" id="personanatural" 
                @if(isset($persona) && $persona->tipopersona_id == 2) style="display: none;" @endif>
                <div class="card-header bg-tema p-1">
                    <strong>Persona natural</strong>                    
                </div>
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <strong>Apellido Paterno</strong>
                                <input type="text" value="{{ isset($persona) && $persona->tipopersona_id == 1 ? $persona->personanatural->apaterno : '' }}" 
                                    name="apellido_paterno" id="apellido_paterno" class="form-control form-control-sm input-required" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <strong>Apellido Materno</strong>
                                <input type="text" value="{{ isset($persona) && $persona->tipopersona_id == 1 ? $persona->personanatural->amaterno : '' }}" 
                                    name="apellido_materno" id="apellido_materno" class="form-control form-control-sm input-required" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <strong>Nombres</strong>
                                <input type="text" value="{{ isset($persona) && $persona->tipopersona_id == 1 ? $persona->personanatural->nombres : '' }}" 
                                    name="nombres" id="nombres" class="form-control form-control-sm input-required" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <strong>Sexo</strong>
                                <select name="sexo" class="form-control form-control-sm">
                                    @foreach(sexo() as $item)
                                    <option value="{{ $item->id }}" 
                                        {{ isset($persona) && $persona->tipopersona_id == 1 && $persona->personanatural->sexo_id == $item->id  ? 'selected' : '' }}>
                                        {{ $item->sexo }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <strong>Estado civil</strong>
                                <select name="estadocivil" class="form-control form-control-sm">
                                    @foreach(estadocivil() as $item)
                                        <option value="{{ $item->id }}" 
                                            {{ isset($persona) && $persona->tipopersona_id == 1 && $persona->personanatural->estadocivil_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->estadocivil }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <strong>Fecha nacimiento</strong>
                                <input type="date" class="form-control form-control-sm" name="fecha_nacimiento" 
                                    value=@if(isset($persona) && $persona->tipopersona_id == 1 && $persona->tipopersona_id == 1) "{{ date('Y-m-d', strtotime($persona->personanatural->fecha_nacimiento)) }}"
                                            @else "{{ date('Y') - 18 }}-01-01" @endif 
                                            min="{{ date('Y') - 100 }}-01-01" max="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <strong>Ocupación</strong>
                                <select name="ocupacion" class="form-control form-control-sm">
                                    @foreach (ocupacion() as $item)
                                        <option value="{{ $item->id }}" 
                                            {{ isset($persona) && $persona->tipopersona_id == 1 && $persona->personanatural->ocupacion_id == $item->id ? 'selected' : ''}}>
                                            {{ $item->ocupacion}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- persona juridica --}}
            <div class="card tipopersona" id="personajuridica"
                @if(!isset($persona))  style="display: none;" @endif 
                @if(isset($persona) && $persona->tipopersona_id == 1) style="display: none;" @endif>
                <div class="card-header bg-tema p-1">
                    <strong>Persona jurídica</strong>
                    <span class="float-right alert-search-dni"></span>
                </div>
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <strong>Razón social</strong>
                                <input type="text" value="{{ isset($persona) && $persona->tipopersona_id == 2 ? $persona->personajuridica->razon_social : '' }}" 
                                    name="razon_social" class="form-control form-control-sm input-required" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <strong>Nombre comercial</strong>
                                <input type="text" value="{{ isset($persona) && $persona->tipopersona_id == 2 ? $persona->personajuridica->nombre_comercial : '' }}" 
                                    name="nombre_comercial" class="form-control form-control-sm" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <strong>Fecha constitución</strong>
                                <input type="date" class="form-control form-control-sm" name="fecha_constitucion"
                                value=@if(isset($persona) && $persona->tipopersona_id == 2) "{{ date('Y-m-d', strtotime($persona->personajuridica->fecha_constitucion )) }}"
                                            @else "{{ date('Y-m-d')  }}" @endif
                                            min="{{ date('Y') - 100 }}-01-01" max="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <strong>Actividad económica</strong>
                                <input type="text" value="{{ isset($persona) && $persona->tipopersona_id == 2 ? $persona->personajuridica->actividad_economica : '' }}" 
                                    name="actividad_economica" class="form-control form-control-sm" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-4 col-12">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <strong>Teléfono</strong>
                <input type="text" value="{{ isset($persona) ? $persona->telefono : '' }}" 
                    name="telefono" class="form-control form-control-sm" autocomplete="off">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <strong>Teléfono adicional</strong>
                <input type="text" value="{{ isset($persona) ? $persona->telefono_adicional : '' }}" 
                    name="telefono_adicional" class="form-control form-control-sm" autocomplete="off">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <strong>E-mail</strong>
                <input type="email" value="{{ isset($persona) ? $persona->email : '' }}" 
                    name="email" class="form-control form-control-sm" autocomplete="off">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <strong>E-mail adicional</strong>
                <input type="email" value="{{ isset($persona) ? $persona->email_adicional : '' }}" 
                    name="email_adicional" class="form-control form-control-sm" autocomplete="off">
            </div>
        </div>
    </div>
</div>
@if(isset($persona))
<div class="col-12">
    <div class="card card-outline card-tema">
        <div class="card-header p-1">
            <strong>Lista de direcciones</strong>
            <button type="button" class="d-none" id="btndirecciones" onclick="dataview('{{ route('personas.direccion.listar', $persona->id) }}','content-direcciones')"></button>
            <button type="button" class="btn btn-default btn-xs float-right" onclick="modal_form('{{ route('personas.direccion.create') }}','-super')"><b><i class="fa fa-plus-circle"></i> Agregar dirección</b></button>
        </div>
        <div class="card-body p-1">
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr class="eab-thead">
                            <th width="50px;">&nbsp;</th>
                            <th class="table-200">Dirección</th>
                            <th>TipoDirección</th>
                            <th class="table-100">Localidad</th>
                            <th class="table-100">Distrito</th>
                            <th class="table-100">Provincia</th>
                            <th class="table-100">Departamento</th>
                            <th class="table-200">Referencia</th>
                        </tr>
                    </thead>
                    <tbody id="content-direcciones">
                        @foreach($persona->direccion()->where('estado',1)->orderBy('principal','DESC')->get() as $item)
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@else
<div class="col-12">
    <p>
        <a class="btn btn-link btn-sm" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            Registrar dirección <i class="fa fa-mouse-pointer"></i>
        </a>
        <input type="hidden" name="envia_direccion" value="0" id="envia_direccion">
    </p>
</div>
<div class="col-12">
    <div class="collapse" id="collapseExample">
        <div class="card card-outline card-tema card-body p-3">
            <div class="row">
                @include('personas.direcciones.plantillaUbigeo')
            </div>
        </div>
    </div>
</div>
@endif

<script>
    // CONSULTA RENIEC
    function getDataPersona(dni)
    {
        if(dni.lenght < 8) return 
        $('.alert-search-dni').html($('#loading_2').html())
        $.ajax({
            type : 'GET',
            url  : "{{ url('persona_dni') }}" + '/' + dni,
            dataType: 'json',
            success: function(data){
                if(data.success){
                    $('#nombres').val(data.data.nombres)
                    $('#apellido_paterno').val(data.data.apellido_paterno)
                    $('#apellido_materno').val(data.data.apellido_materno)
                }else{
                    alert('documento no encontrado')
                }

                $('.alert-search-dni').html('')
            }
        });
    }
    // FIN CONSULTA RENIEC
</script>