<div class="mb-3 col-12">
    <button class="btn btn-tema btn-sm" onclick="modal_form('{{ route('roles.create') }}')"><i class="fa fa-plus-circle"></i> Registrar Perfil</button>
</div>

<div class="col-12">
    <div class="card card-outline card-tema">
        <div class="p-2 card-header">             
            <strong class="title-lst"> Mantenimiento de Perfiles</strong>
        </div>
        <div class="p-2 card-body ">
            <div class="table-responsive">
                <table id="roles" class="table table-sm table-bordered">
                    <thead class="bg-tema">
                        <tr>
                            <td class="d-none">&nbsp;</td>
                            <th width="35px">&nbsp;</th>
                            <th>Perfil</th>
                            <th>Descripción</th>
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
                { data: 'id' , className:'d-none'},
                { data: 'btn', className: 'text-center p-1'},
                { data: 'name'},
                { data: 'description'}
            ]
        const btn = []

        lst_datatable('roles',"{{ route('roles.list') }}", data, btn)
    })
</script>
