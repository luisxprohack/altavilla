@php
 $valores = [
     '1' => 'Hospedaje',
     '2' => 'Administrativo',
     '3' => 'Gráficos'
 ]
@endphp
<form action="{{ route('roles.estadistica', $id) }}" method="POST" class="formentrada" id="add-estadistica">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <div class="list-group">
                    <div class="list-group-item"><label><input type="checkbox" name="estadistica[]" value="1"
                        {{ estadistica_role($id,1) ? 'checked' : '' }}> <b>Hospedaje</b></label></div>
                    <div class="list-group-item"><label><input type="checkbox" name="estadistica[]" value="2"
                        {{ estadistica_role($id,2) ? 'checked' : '' }}> <b>Administrativo</b></label></div>
                    <div class="list-group-item"><label><input type="checkbox" name="estadistica[]" value="3"
                        {{ estadistica_role($id,3) ? 'checked' : '' }}> <b>Gráficos</b></label></div> 
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer p-0 d-block">
        <button type="button" class="btn btn-danger" id="close_modal" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Salir</button>
        <button type="submit" class="btn btn-info float-right">
            <span class="spinner-border spinner-border-sm mr-1" style="display: none;" id="loading-add-estadistica"></span>
            <i class="fa fa-save"></i> Guardar</button>
    </div>
</form>
