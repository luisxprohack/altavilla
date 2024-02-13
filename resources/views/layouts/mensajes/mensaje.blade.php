<div class="row m-2">
    <div class="col-12 text-center">
        @if($validacion)
            <div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;"><div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>
                <div class="swal2-success-ring"></div> <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
            </div>
        @else
            <div class="swal2-icon swal2-error swal2-icon-show" style="display: flex;">
                <span class="swal2-x-mark">
                    <span class="swal2-x-mark-line-left"></span>
                    <span class="swal2-x-mark-line-right"></span>
                </span>
            </div>
        @endif
    </div>
    <div class="col-12 text-center mb-2">
        <p><strong>{{{ $mensaje }}}</strong></p>
        <button class="btn btn-tema btn-lg" id="getMensajeGeneral" data-dismiss="modal">Aceptar</button>              
    </div>
</div>
