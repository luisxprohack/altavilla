  
<div class="col-md-8 col-sm-10 col-12">
    <div class="card card-outline card-tema">
        <div class="card-header p-2">             
            <strong class="title-lst">Listado de Tipo Comprobantes</strong>
        </div>
        <div class="card-body p-2 ">
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead class="bg-tema">
                        <tr>
                            <th width='50px'>&nbsp;</th>
                            <th class="table-150">Tipo comprobante</th>
                            <th>Abreviatura</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datos as $item)
                        <tr id="categoria{{ $item->id }}">
                            <td class="bg-tema text-center">{{ $item->id }}</td>
                            <td>{{ $item->tipocomprobante }}</td>
                            <td>{{ $item->nombre_corto }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>