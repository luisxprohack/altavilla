<!DOCTYPE html>
<html lang="en">

  @include('layouts.partials.head')

  <style type="text/css">
    /* estilo se scrolbar */
    .sidebar::-webkit-scrollbar-thumb,
    .sidebar-mini.sidebar-collapse::-webkit-scrollbar-thumb {
      background: #ccc !important;
      border-radius: 5px;
      border-right: 2px solid {{ $variables->bg_tema }};
    }

    /* Confirguracion Datatable */
    .dataTables_paginate .pagination .active a  {
        color: white !important;
        border: 1px solid {{ $variables->bg_tema }} !important;
        background-color: {{ $variables->bg_tema }} !important;
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, {{ $variables->bg_tema }} ), color-stop(100%, {{ $variables->bg_tema }} ))!important;
        background: -webkit-linear-gradient(top, {{ $variables->bg_tema }}  0%, {{ $variables->bg_tema }}  100%)!important;
        background: -moz-linear-gradient(top, {{ $variables->bg_tema }}  0%, {{ $variables->bg_tema }}  100%)!important;
        background: -ms-linear-gradient(top, {{ $variables->bg_tema }}  0%, {{ $variables->bg_tema }}  100%)!important;
        background: -o-linear-gradient(top, {{ $variables->bg_tema }}  0%, {{ $variables->bg_tema }}  100%)!important;
        background: linear-gradient(to bottom, {{ $variables->bg_tema }}  0%, {{ $variables->bg_tema }}  100%)!important;
    }

    .dataTables_paginate .pagination a{
      color: {{ $variables->bg_tema }} !important;
    }

    .dataTables_paginate .pagination .disabled a{
      color: #86888A !important;
    }

    /* Fin configuracion Datatable*/  

    /* Plantilla */
      .sidebar a{
        color: {{ $variables->orientacion == 2 ? '#6e768e' : $variables->color_link_dashboard }} !important;
      }
      .brand-link span{
        color: {{ $variables->orientacion == 2 ? $variables->color_link_header : $variables->color_link_dashboard }} !important;
      }

      @if($variables->orientacion == 2)
        .brand-link{
          border-bottom: none !important;
        }
        .sidebar a:hover {
          color: {{ $variables->bg_tema }} !important;  
        }
        .sidebar a:focus, .sidebar a:active {
          color: {{ $variables->bg_tema }} !important; 
          font-weight: bold;
        }
      @endif

      .navbar-light .navbar-nav .nav-link {
        color: {{ $variables->orientacion == 1 ? '' : $variables->color_link_header }} !important;
      }

      .bg-tema{
          background-color: {{ $variables->bg_tema }} !important;
          color: #fff !important;
      }

      .text-tema{
        color: {{ $variables->bg_tema }} !important;
      }
      .border-tema{
        border: 1px solid {{ $variables->bg_tema }} !important;
      }

      .card-tema.card-outline {
        border-top: 3px solid {{ $variables->bg_tema }} !important;
      }

      /*ESTILOS DEL BOTON PRINCIPAL*/
      .btn-outline-tema:hover {
        color: #fff !important;
        background-color: {{ $variables->bg_tema }} !important;
        border-color: {{ $variables->bg_tema }} !important;        
      }

      .btn-outline-tema {
        color: {{ $variables->bg_tema }} !important;
        border-color: {{ $variables->bg_tema }} !important;
        background-color: transparent !important;
      }

      .btn-outline-tema:focus, .btn-outline-tema.focus {
        box-shadow: 0 0 0 0 rgba(0, 123, 255, 0.5);
      }

      .btn-tema {
        color: #fff;
        background-color: {{ $variables->btn_tema }};
        border-color: opacity(0.5);
        box-shadow: none;
      }

      .btn-tema:hover {
        color: #fff;
        opacity: 0.95;
        border-color: {{ $variables->btn_tema }};
      }

      .btn-tema:focus, .btn-tema.focus {
        color: #fff;
        opacity: 0.95;
        border-color: {{ $variables->btn_tema }};
      }

      .nav-icon{
          color: {{ $variables->nav_icon}};
      }
    /*Fin Plantilla*/

  </style>

  <script>
    const colorTemaBtn = "{{ $variables->btn_alert }}",
          baseUrl = "{{ url()->full() }}",
          minutosAlerta = {{ $variables->time_minutos_alerta }} * 60 * 1000
  </script>

<body class="hold-transition layout-fixed layout-navbar-fixed sidebar-mini">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img src="{{ asset('img/' . $variables->logo ) }}" alt="2eabLogo" width="150" height="120">
      <div class="mt-4 spinner-border text-tema" style="width: 2rem; height: 2rem;" role="status">
        <span class="visually-hidden"></span>
      </div>
    </div>
    
    <!-- Congela la página completa -->
    <div class="loading-eab" id="loading-eab"></div>

    <!-- BARRA DE NAVEGACION -->
    @include('layouts.partials.header')
    <!-- FIN BARRA NAVEGACION -->

    <!-- Main Sidebar Container -->
    @include('layouts.partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper"> 
        <div class="content-header">
          <div class="container-fluid">
            <div class="row" id="content-lst">
              @yield('content')
            </div>
          </div>
        </div> 
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; {{ date('Y') }} {{ Str::limit(config('app.name', '2eab.com') ,15) }}.</strong>
      Todos los derechos reservados.
      <div class="float-right d-none d-sm-inline-block">
        <a href="https://www.2eab.com" class="text-secondary" target="_blank">2eab.com</a>
      </div>
    </footer>
  </div>
  <!-- ./wrapper -->

  @include('layouts.modals.modal')

  @include('layouts.partials.script')

  {{--}}
  <script>
    window.onload=alert_informativo()
  </script>
  --}}

</body>
</html>
