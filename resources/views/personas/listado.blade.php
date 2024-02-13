<div class="mb-3 col-12">
    @can('personas.listado.registrar')
    <button class="btn btn-tema btn-sm" onclick="modal_form('{{ route('personas.create') }}','-lg')"><i class="fa fa-plus-circle"></i> Registrar persona</button>
    @endcan
</div>

<div class="col-12">
    <div class="card card-outline card-tema">
        <div class="p-2 card-header">             
            <strong class="title-lst"> Mantenimiento de personas</strong>
            <div class="float-right form-row"> 
                <div class="col-auto">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text form-control-sm">Estado</div>
                    </div>
                    <select id="estado" class="form-control form-control-sm filterTable">
                        <option value="1">Activos</option>
                        <option value="0">Eliminados</option>
                    </select>
                  </div>
                </div>
            </div>
        </div>
        <div class="p-2 card-body ">
            <div class="table-responsive">
                <table id="personas" class="table table-sm table-bordered">
                    <thead class="bg-tema">
                        <tr> 
                            <th class="d-none">1</th>
                            <th width="35px">&nbsp;</th>
                            <th>TipoPersona</th>
                            <th class="table-200">Datos</th>
                            <th>TipoDocumento</th>
                            <th>Documento</th>
                            <th>Telefono</th>
                            <th class="table-150">Email</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script>  
    var data = [
            { data: 'id' , className: 'd-none'},
            { data: 'btn', 'className': 'text-center p-1'},    
            { data: 'tipopersona.tipopersona'},
            { data: 'datos' },
            { data: 'tipodocumento.nombre_corto'},
            { data: 'documento', 'className' : 'text-center' },
            { data: 'telefono'},
            { data: 'email' }
        ]
    var btn = [
        {
            extend: 'pdf',
            title: 'Listado de Personas',
            filename: 'personas',
            download: 'open',
            text: '<i class="fa fa-file-pdf text-danger"></i> PDF',
            className: 'btn btn-default mr-1 btn-sm',
            orientation: 'landscape',
            exportOptions: {
                columns: [2,3,4,5,6,7]
            }
        },
        {
            extend: 'excel',
            title: 'Listado de Personas',
            filename: 'personas',
            text: '<i class="fa fa-file-excel text-success"></i> Excel',
            className: 'btn btn-default btn-sm',
            exportOptions: {
                columns: [2,3,4,5,6,7]
            }
        }
    ]

    $(document).ready(function() {   
        lst_datatable('personas',"{{ route('personas.list') }}", data, btn, { estado : 1 })
    })

    $('.filterTable').on('change', function(){
        $('#personas').DataTable().destroy()

        let parametros = {
            estado : $('#estado').val()
        }

        lst_datatable('personas',"{{ route('personas.list') }}", data, btn, parametros)
    }) 

    
</script>
