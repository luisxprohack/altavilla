<div class="col-12 mb-3">
    <button class="btn btn-tema btn-sm" onclick="modal_form('{{ route('parametrizar.create', 'marcas') }}')"><i class="fa fa-plus-circle"></i> Registrar Marca</button>
    <button id="btnparametrizar" style="display: none;" onclick="dataview('{{ url('parametrizars/marcas') }}','content-lst')"></button>
</div>
    
<div class="col-md-8 col-sm-10 col-12">
    <div class="card card-outline card-tema">
        <div class="card-header p-2">             
            <strong class="title-lst">Mantenimiento de Marcas</strong>
        </div>
        <div class="card-body p-2 ">
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead class="bg-tema">
                        <tr>
                            <th width='50px'>&nbsp;</th>
                            <th class="table-150">Categoría</th>
                            <th>Abreviatura</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datos as $item)
                        <tr id="marca{{ $item->id }}">
                            <td class="text-center p-1">
                                <div class="dropdown">
                                    <button class="btn btn-outline-tema btn-sm btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fa fa-cogs"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="modal_form('{{ route('parametrizar.edit',[$item->id, 'marcas']) }}')">Modificar</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="delete_confirm('{{ route('parametrizar.delete', [$item->id,'marcas',5]) }}','Se eliminará la marca!','eliminar','marca{{ $item->id }}',1)">Eliminar</a>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item->marca }}</td>
                            <td>{{ $item->nombre_corto }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>