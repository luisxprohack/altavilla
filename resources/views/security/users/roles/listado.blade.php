<div class="col-12">
    <div class="card card-outline card-tema">
        <div class="card-header p-2">             
            <strong class="title-lst"> Asignar Perfiles a Usuarios</strong>
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
                <table id="perfiles" class="table table-sm table-bordered">
                    <thead class="bg-tema">
                        <tr>
                            <td class="d-none">&nbsp;</td>
                            <th width="100px">&nbsp;</th>
                            <th>Apellidos y Nombres</th>
                            <th>Agencia</th>
                            <th>Perfiles</th>
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
            { data: 'perfil'}
        ]
    var btn = []

    $(document).ready(function() {      
        lst_datatable('perfiles',"{{ route('users.roles.list') }}", data, btn, { agencia : 0 }, [1,3,4])
    })

    $('.filterTable').on('change', function(){
        $('#perfiles').DataTable().destroy()

        let parametros = {
            agencia : $('#cb_agencia').val()
        }

        lst_datatable('perfiles',"{{ route('users.roles.list') }}", data, btn, parametros,[1,3,4])
    }) 
</script>

