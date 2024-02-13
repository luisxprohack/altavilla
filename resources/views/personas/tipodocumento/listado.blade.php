<div class="col-12 mb-3">
    <button class="btn btn-tema btn-sm" onclick="modal_form('{{ route('tipodocumento.create') }}')"><i class="fa fa-plus-circle"></i> Registrar tipo documento</button>
    <button id="btntipodocumento" style="display: none;" onclick="dataview('{{ route('tipodocumentos') }}','content-lst')"></button>
</div>
    
<div class="col-12">
    <div class="card card-outline card-tema">
        <div class="card-header p-2">             
            <strong class="title-lst"> Tipo documentos</strong>
        </div>
        <div class="card-body p-2 ">
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead class="eab-thead">
                        <tr>
                            <th width='50px'>&nbsp;</th>
                            <th class="table-250">Tipo Documento</th>
                            <th>Abreviatura</th>
                            <th class="table-150">P. Natural</th>
                            <th class="table-150">P. Juridica</th>
                            <th>Caracteres</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tipodocumentos as $item)
                        <tr id="tipodocumento{{ $item->id }}">
                            <td class="text-center p-0">
                                <div class="dropdown">
                                    <button class="btn btn-default btn-sm btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fa fa-cogs"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="modal_form('{{ route('tipodocumento.edit', $item->id) }}')">Modificar</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="delete_confirm('{{ route('tipodocumento.delete', $item->id) }}','Se eliminara el tipo documento!','eliminar','tipodocumento{{ $item->id }}',1)">Eliminar</a>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item->tipodocumento }}</td>
                            <td>{{ $item->nombre_corto }}</td>
                            <td class="text-center"><span class="badge badge-{{ $item->per_natural == 1 ? 'success' : 'danger' }}">{{ $item->per_natural == 1 ? 'SI' : 'NO'}}</span></td>
                            <td class="text-center"><span class="badge badge-{{ $item->per_juridica == 1 ? 'success' : 'danger' }}">{{ $item->per_juridica == 1 ? 'SI' : 'NO'}}</span></td>
                            <td class="text-center">{{ $item->caracter }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>