<div class="col-12 mb-3">
    <button class="btn btn-tema btn-sm" onclick="modal_form('{{ route('parametrizar.create', 'unidadmedidas') }}')"><i class="fa fa-plus-circle"></i> Registrar Unidad de Medida</button>
    <button id="btnparametrizar" style="display: none;" onclick="dataview('{{ url('parametrizars/unidadmedidas') }}','content-lst')"></button>
</div>
    
<div class="col-md-8 col-sm-10 col-12">
    <div class="card card-outline card-tema">
        <div class="card-header p-2">             
            <strong class="title-lst">Mantenimiento de Unidad de Medida</strong>
        </div>
        <div class="card-body p-2 ">
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead class="bg-tema">
                        <tr>
                            <th width='50px'>&nbsp;</th>
                            <th class="table-150">Unidad de Medida</th>
                            <th>Abreviatura</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datos as $item)
                        <tr id="unidadmedida{{ $item->id }}">
                            <td class="text-center p-1">
                                <div class="dropdown">
                                    <button class="btn btn-outline-tema btn-sm btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fa fa-cogs"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="modal_form('{{ route('parametrizar.edit',[$item->id, 'unidadmedidas']) }}')">Modificar</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="delete_confirm('{{ route('parametrizar.delete', [$item->id,'unidadmedidas',5]) }}','Se eliminará la unidad de medida!','eliminar','unidadmedida{{ $item->id }}',1)">Eliminar</a>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item->unidadmedida }}</td>
                            <td>{{ $item->nombre_corto }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>