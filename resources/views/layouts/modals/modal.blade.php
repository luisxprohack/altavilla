<iframe class="d-none" src="" frameborder="0" width="200" height="100" id="frame_impresion"></iframe>

{{-- 
  Modal para buscar persona 
  
  reinicia-modal sirve para limpiar los contenedores
--}}
<div class="modal fade mt-3" id="modal-static-super" data-backdrop="static"
    data-keyboard="false" tabindex="-1" aria-labelledby="buscarPersonaLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-tema p-1">
          <h5 class="modal-title font-weight-bold">
            <i class="fab fa-delicious pr-1"></i>
            <span id="title-modal-static-super">Buscar persona</span>
          </h5>
        </div>
        <div class='reinicia-modal' id="content-modal-static-super"></div>
      </div>
    </div>
  </div>

  <!-- Modal Nuevo Formulario-->
<div class="modal fade" id="modal-static" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header eab-thead border-bottom border-secondary p-2">
          <h5 class="modal-title font-weight-bold">
            <i class="fab fa-delicious pr-1"></i>
            <span id="title-modal-static"></span>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-modal">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class='reinicia-modal' id="content-modal-static"></div>
      </div>
    </div>
  </div>

   <!-- Modal Nuevo Formulario Large-->
<div class="modal fade" id="modal-static-lg" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header eab-thead border-bottom border-secondary p-2">
          <h5 class="modal-title font-weight-bold">
            <i class="fab fa-delicious pr-1"></i>
            <span id="title-modal-static-lg"></span>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-modal">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class='reinicia-modal' id="content-modal-static-lg"></div>
      </div>
    </div>
  </div>

  {{-- Iamgen para mostrar un loading --}}
  <div class="d-none" id="loading">
    <div class="p-2"><div class="spinner-border text-tema" role="status">
        <span class="sr-only">Loading...</span>
    </div></div>
  </div>
  <div class="d-none" id="loading_2">
    <span class="spinner-border spinner-border-sm text-tema" role="status" aria-hidden="true"></span>
  </div>

  {{-- mensaje para mostrar si la peticion genera un error --}}
  <div class="d-none" id="content-error-peticion">
    <div class="modal-body">
        <div class=" text-danger">
            <strong id="msj-error-peticion"></strong>
        </div>
        <div class="text-right">
            <button type="button" class="btn btn-tema" data-dismiss="modal"> Ok!</button>
        </div>
    </div>
  </div>