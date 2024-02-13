
<nav class="main-header navbar navbar-expand navbar-white navbar-light 
  {{ $variables->orientacion == 2 ? 'bg-tema' : '' }}
">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- Items en el menu principal 
       <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto"> 

      <!-- Menu desplegable de mensajes 
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item"> -->
            <!-- Message Start -->
            <!-- <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div> -->
            <!-- Message End -->
          <!-- </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div> 
      </li>-->

      <!-- Menu desplegable de notificaciones -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-danger navbar-badge">0</span>
        </a>
        <!-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div> -->
      </li>

      <li class="nav-item dropdown user-menu">    
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('img/' . $user->avatar) }}" class="user-image img-circle elevation-2" alt="Image user">
            <span class="d-none d-md-inline">{{ ucwords(strtolower(Str::limit($user->persona->datos,15))) }}</span>
        </a>        
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">            
            <li class="user-header bg-tema">
              <img src="{{ asset('img/' . $user->avatar) }} " class="img-circle elevation-2" alt="Datos de Usuario">
              <p class="">{{ ucwords(strtolower(Str::limit($user->persona->datos))) }}<small>{{ $user->cargo->cargo }}</small></p>
            </li>
            <li class="user-footer">
              <a href="javascript:void(0)" onclick="modal_form('{{ route('users.perfil') }}','-lg')" class="btn btn-default btn-flat">
                        <i class="fa fa-fw fa-user"></i>
                        Perfil
                    </a>
                
                <a class="btn btn-default btn-flat float-right " href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out-alt"></i>
                    Cerrar sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
            </li>

        </ul>

    </li>

      <!-- 
        OPCION DE EXPANDIR EL SISTEMA A PANTALLA COMPLETA

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li> -->
    </ul>
  </nav>