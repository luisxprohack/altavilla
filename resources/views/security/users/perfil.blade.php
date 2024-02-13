<div class="modal-body p-2">
    <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="false"><span class="text-tema">Datos Generales</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="true"><span class="text-tema">Datos de Acceso</span></a>
        </li>
    </ul>
    
    <div class="tab-content" id="custom-content-below-tabContent">
        <div class="tab-pane active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
            <form action="{{ route('personas.update',$persona->id) }}" method="POST" class="formentrada" id="add-persona">
                @csrf                
               <div class="row">
                    @include('personas.plantilla_data')
                    <div class="col-12 mt-2">
                        <button type="button" class="btn btn-link text-tema" id="close_modal" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Salir</button>
                        <button type="submit" class="btn btn-tema float-right">
                            <span class="spinner-border spinner-border-sm mr-1" style="display: none;" id="loading-add-persona"></span>
                            <i class="fa fa-edit"></i> Modificar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
            <form action="{{ route('users.acceso', $user->id) }}" method="POST" class="formacceso" id="up-accesos">
                @csrf                
               <div class="row p-5">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <strong>Contraseña</strong>
                            <input type="password" name="password" class="form-control form-control-sm" >
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <strong>Confirmar Contraseña</strong>
                            <input type="password" name="password_confirmation" class="form-control form-control-sm">
                        </div>
                    </div>  
                    <div class="col-12 mt-4">
                        <hr>
                        <button type="button" class="btn btn-link text-tema" id="close_modal" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Salir</button>
                        <button type="submit" class="btn btn-tema float-right">
                            <span class="spinner-border spinner-border-sm mr-1" style="display: none;" id="loading-up-accesos"></span>
                            <i class="fa fa-edit"></i> Modificar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).on("submit", ".formacceso", function (e) {
    e.preventDefault()
    let form = $(this)
    $('#loading-up-accesos').css("display","inline-block")
    /* Bloquea pantalla */
    $('#loading-eab').css('display','block');

    $.ajax({
        type: 'POST',
        url: "{{ route('users.acceso') }}",
        cache: false,
        dataType: 'json',
        data: form.serialize(),
        success: function(data){
            $('#loading-up-accesos').css("display","none")
            if (data.success){                
                Swal.fire({
                    icon: 'success',
                    title: 'Exito!',
                    html: `${data.view}`,
                    confirmButtonText: 'Ok!',
                    confirmButtonColor: colorTemaBtn
                })
                $(`#${form.attr('id')} #close_modal`).click()
                setTimeout(() => {
                    location.reload() 
                }, 1200);
            }else{
                Swal.fire({
                    html: `${data.view}`,
                    confirmButtonText: 'Ok!',
                    confirmButtonColor: colorTemaBtn
                })
            }

            /* Desbloquea pantalla */
            $('#loading-eab').css('display','none');
        },
        error: function(e){            
            $('#loading-up-accesos').css("display","none")
            Swal.fire({
                icon: 'error',
                text: `${error_status(e.status)}`,
                confirmButtonText: 'Ok!',
                confirmButtonColor: colorTemaBtn
            })
            /* Desbloquea pantalla */
            $('#loading-eab').css('display','none');
        }
    })
})
</script>