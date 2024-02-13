<div class="col-12 mb-3">
    <button class="btn btn-tema btn-sm" onclick="modal_form('{{ route('users.create') }}')"><i class="fa fa-plus-circle"></i> Registrar Usuario</button>
</div>

<div class="col-12">
    <div class="card card-outline card-tema">
        <div class="card-header p-2">             
            <strong class="title-lst"> Mantenimiento de usuarios</strong>
            <div class="form-row float-right"> 
                <div class="col-auto">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text form-control-sm">Agencia</div>
                    </div>
                    <select id="cb_agencia" class="form-control form-control-sm filterTable">
                        <option value="0">TODAS</option>
                        @foreach($agencia as $item)
                        <option value="{{ $item->id }}">{{ $item->agencia }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
            </div>
        </div>
        <div class="card-body p-2 ">
            <div class="table-responsive">
                <table id="users" class="table table-sm table-bordered">
                    <thead class="bg-tema">
                        <tr>
                            <td class="d-none">&nbsp;</td>
                            <th width="35px">&nbsp;</th>
                            <th>Apellidos y Nombres</th>
                            <th>Agencia</th>
                            <th>Cargo</th>
                            <th>Email</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    var data = [
            { data: 'id' , className:'d-none'},
            { data: 'btn', className: 'text-center p-1'},
            { data: 'persona.datos' },
            { data: 'agencia.agencia' },
            { data: 'cargo.cargo'},
            { data: 'email'},
            { data: 'estado'},
        ]
    var btn = [
        {
            extend: 'pdf',
            title: 'Listado de Usuarios',
            filename: 'articulos',
            download: 'open',
            text: '<i class="fa fa-file-pdf text-danger"></i> PDF',
            className: 'btn-default mr-1 btn-sm',
            orientation: 'landscape',
            exportOptions: {
                columns: [2,3,4,5,6]
            }
        },
        {
            extend: 'excel',
            title: 'Listado de Usuarios',
            filename: 'articulos',
            text: '<i class="fa fa-file-excel text-success"></i> Excel',
            className: 'btn-default btn-sm',
            exportOptions: {
                columns: [2,3,4,5,6]
            }
        }
    ]

    $(document).ready(function() {      
        lst_datatable('users',"{{ route('users.list') }}", data, btn, { agencia : 0 }, [1,3,4])
    })

    $('.filterTable').on('change', function(){
        $('#users').DataTable().destroy()

        let parametros = {
            agencia : $('#cb_agencia').val()
        }

        lst_datatable('users',"{{ route('users.list') }}", data, btn, parametros,[1,3,4])
    }) 
</script>
