<div class="col-12 mb-3">
    <button class="btn btn-tema btn-sm" onclick="modal_form('{{ route('agencia.create') }}')"><i class="fa fa-plus-circle"></i> Registrar agencia</button>
</div>

<div class="col-12">
    <div class="card card-outline card-tema">
        <div class="card-header p-2">             
            <strong class="title-lst"> Lista de Agencia</strong> 
        </div>
        <div class="card-body p-2 ">
            <div class="table-responsive">
                <table id="agencia" class="table table-sm table-bordered">
                    <thead class="bg-tema">
                        <tr> 
                            <th class="d-none">1</th>
                            <th width="35px">&nbsp;</th>
                            <th class="table-200">Agencia</th>
                            <th>Telefono</th>
                            <th>Direccion</th>
                            <th>Departamento_Provincia_Distrito</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script>     

    $(document).ready(function() { 
        const data = [
            { data: 'id' , className: 'd-none'},
            { data: 'btn', 'className': 'text-center p-1'},    
            { data: 'agencia'},
            { data: 'telefono' },
            { data: 'direccion' },
            { data: 'ubigeo'}
        ]
        const btn = []  
        lst_datatable('agencia',"{{ route('agencia.list') }}", data, btn)
    })
    
</script>
