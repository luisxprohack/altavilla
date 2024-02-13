<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    <link rel="icon" href="{{ asset('img/' . $variables->favicon ) }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte3/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte3/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte3/dist/css/adminlte.min.css') }}">
    
    <style type="text/css">
      body{
        background: {{ $variables->bg_tema }};
        background: linear-gradient(0deg, {{ $variables->bg_tema }} 0%, #f8fafc 90%);
        font-family: 'Nunito', sans-serif;
        color: #4F4F4F;
      }

      .text-tema{
        color: {{ $variables->bg_tema }};
      }

      .btn-tema {
        color: #fff;
        background-color: {{ $variables->bg_tema }};
        border-color: opacity(0.5);
        box-shadow: none;
      }

      .btn-tema:hover {
        color: #fff;
        opacity: 0.95;
        border-color: {{ $variables->bg_tema }};
      }

      .btn-tema:focus, .btn-tema.focus {
        color: #fff;
        opacity: 0.95;
        border-color: {{ $variables->bg_tema }};
      } 

      .icheck-olive > input:first-child:not(:checked):not(:disabled):hover + label::before,
      .icheck-olive > input:first-child:not(:checked):not(:disabled):hover + input[type="hidden"] + label::before {
        border-color: {{ $variables->bg_tema }} !important;
      } 

      .icheck-olive > input:first-child:checked + label::before,
      .icheck-olive > input:first-child:checked + input[type="hidden"] + label::before {
        background-color: {{ $variables->bg_tema }} !important;
        border-color: {{ $variables->bg_tema }} !important;
      }

      .linea1{
        border-color: white;
        border-style: solid;
        border-width: 3px 0px 3px 0px;
        width: 100%;
        position: absolute;
        bottom: 15px;
        padding: 5px;
      }
      .linea2{
        border-color: white;
        border-style: solid;
        border-width: 0px 0px 0px 3px;
        height: 100%;
        position: absolute;
        bottom: 30px;
        right: 10px; 
        margin-bottom: -30px;
      }

      .linea3{
        width: 100%;
        text-align: center; 
        position: absolute; 
        bottom: 10px;
        font-size: 10vw;
        background: -webkit-linear-gradient(#f8fafc,{{ $variables->bg_tema }});
         -webkit-background-clip: text;
         -webkit-text-fill-color: transparent;
        color: #f8fafc;
        z-index: -1;
      }
    </style>

  </head>

<body>
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img src="{{ asset('img/' . $variables->logo ) }}" alt="AdminLTELogo" width="150" height="120">
    <div class="spinner-border text-tema mt-4" style="width: 2rem; height: 2rem;" role="status">
    <span class="visually-hidden"></span>
  </div>
  </div>


  <div class="container">

    @yield('content')

  </div>

  <!-- <p class="linea3">2eab</p> -->
  <div class="linea1"></div>
  <div class="linea2"></div>
  
  <!-- jQuery -->
<script src="{{ asset('adminlte3/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte3/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('adminlte3/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>


</body>
</html>

