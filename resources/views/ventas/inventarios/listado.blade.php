<div class="col-12 mb-3">
    <button class="btn btn-tema btn-sm" onclick="modal_form('{{ route('inventario.create') }}')"><i class="fa fa-plus-circle"></i> Registrar inventario</button>
</div>

<div class="col-12">
    <div class="card card-outline card-tema">
        <div class="card-header p-2 d-flex justify-content-between align-items-center">
            <strong class="title-lst mb-0">Lista de Inventario</strong>
            <div class="form-inline">
                <label class="mr-2" for="estadoSelect">Estado:</label>
                <select class="form-control form-control-sm" id="estado">
                    <option value="1" selected>Activos</option>
                    <option value="0">Inactivos</option>
                </select>
            </div>      
        </div>
        <div class="card-body p-2 ">
            <div class="table-responsive">
                <table id="inventario" class="table table-sm table-bordered">
                    <thead class="bg-tema">
                        <tr> 
                            <th class="d-none">1</th>
                            <th width="35px">&nbsp;</th>
                            <th class="table-200">Tipo</th>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Peso Unitario</th>
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
            { data: 'id', className: 'd-none' },
            { data: 'btn', className: 'text-center p-1' },
            { data: 'tipo' },
            { data: 'codigo' },
            { data: 'descripcion' },
            { data: 'peso_unitario' },
        ];
        const btn = [];

        // Inicialización de la tabla DataTable con el estado inicial
        lst_datatable('inventario', "{{ route('inventario.list') }}", data, btn, { estado: 1 });

        // Manejo del evento change en el select para filtrar la tabla
        $('#estado').on('change', function() {
            // Destruir la tabla DataTable existente
            $('#inventario').DataTable().destroy();

            // Obtener el estado seleccionado
            let estado = $(this).val();

            // Parámetros para la función de la tabla DataTable
            let parametros = { estado: estado };

            // Crear una nueva tabla DataTable con el estado seleccionado
            lst_datatable('inventario', "{{ route('inventario.list') }}", data, btn, parametros);
        });
    });
</script>





    
