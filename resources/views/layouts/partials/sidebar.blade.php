
<aside class="main-sidebar sidebar-dark-primary elevation-3  
  {{ $variables->orientacion == 1 ? 'bg-tema' : 'bg-light' }}
">
    <!-- Brand Logo -->
    <a href="{{ url()->full() }}" class="ml-0 brand-link bg-tema ">
      {{--<img src="{{ asset('img/' . $variables->icono) }}" alt="Logo" class="brand-image img-circle"> --}}
      <span class="brand-text font-weight">{{ Str::limit(config('app.name', '2eab.com') ,25) }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar ">

      <!-- Opciones de seguridad -->
      @include("layouts.partials.modulos.seguridad")
      <!-- /.fin seguridad -->
    </div>
    <!-- /.sidebar -->
  </aside>