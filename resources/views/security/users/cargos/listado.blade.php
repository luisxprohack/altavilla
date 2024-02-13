<div class="col-12 mb-3">
    <button class="btn btn-tema btn-sm" onclick="modal_form('{{ route('cargos.create') }}')"><i class="fa fa-plus-circle"></i> Registrar cargo</button>
</div>

<div class="col-sm-8 col-12">
    <div class="card card-outline card-tema">
        <div class="card-header p-2">             
            <strong class="title-lst"> Lista de cargos</strong>
            <div class="form-row float-right"> 
                <div class="col-auto">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text form-control-sm">Area</div>
                    </div>
                    <select id="area" class="form-control form-control-sm filterTable">
                        @foreach($area as $item)
                        <option value="{{ $item->id }}">{{ $item->area }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
            </div>
        </div>
        <div class="card-body p-2 ">
            <div class="table-responsive">
                <table id="cargos" class="table table-sm table-bordered">
                    <thead class="bg-tema">
                        <tr> 
                            <th class="d-none">1</th>
                            <th width="35px">&nbsp;</th>
                            <th class="table-150">Area</th>
                            <th class="table-150">Cargo</th>
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
            { data: 'area.area'},
            { data: 'cargo' },
        ]
    var btn = []

    $(document).ready(function() {   
        lst_datatable('cargos',"{{ route('cargos.list') }}", data, btn, { area : 0 })
    })

    $('.filterTable').on('change', function(){
        $('#cargos').DataTable().destroy()

        let parametros = {
            area : $('#area').val()
        }

        lst_datatable('cargos',"{{ route('cargos.list') }}", data, btn, parametros)
    }) 

    
</script>
