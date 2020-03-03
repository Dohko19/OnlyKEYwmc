<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title', 'Key | Inicio')</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="user" content="Auth::user()">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminLTE/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/summernote/summernote-bs4.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script>
    window.laravel ={
      csrfToken: "{{ csrf_token() }}"
    }
  </script>

  <style>
      .loader-page {
        position: fixed;
        z-index: 25000;
        background: rgb(255, 255, 255);
        left: 0px;
        top: 0px;
        height: 100%;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition:all .3s ease;
      }
      .loader-page::before {
        content: "";
        position: absolute;
        border: 2px solid rgb(50, 150, 176);
        width: 60px;
        height: 60px;
        border-radius: 50%;
        box-sizing: border-box;
        border-left: 2px solid rgba(50, 150, 176,0);
        border-top: 2px solid rgba(50, 150, 176,0);
        animation: rotarload 1s linear infinite;
        transform: rotate(0deg);
      }
      @keyframes rotarload {
          0%   {transform: rotate(0deg)}
          100% {transform: rotate(360deg)}
      }
      .loader-page::after {
        content: "";
        position: absolute;
        border: 2px solid rgba(50, 150, 176,.5);
        width: 60px;
        height: 60px;
        border-radius: 50%;
        box-sizing: border-box;
        border-left: 2px solid rgba(50, 150, 176, 0);
        border-top: 2px solid rgba(50, 150, 176, 0);
        animation: rotarload 1s ease-out infinite;
        transform: rotate(0deg);
      }
  </style>
  @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  {{-- @include('layouts.partials.nav') --}}
<nav class="main-header navbar navbar-expand navbar-blue navbar-dark">
  <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('admin.index') }}" class="nav-link">WMC</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('exports.home') }}" class="nav-link"><i class="fas fa-file-export"></i></a>
      </li>
    </ul>
  <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="nav-icon far fa-user"></i>
          {{ Auth::user()->name }}
          <span class="badge badge-warning navbar-badge"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Acciones</span>
          <div class="dropdown-divider"></div>
          <a href="{{ route('admin.users.edit', auth()->user()->id) }}" class="dropdown-item">
            <i class="far fa-user-circle"></i> {{ __('Mi Perfil') }}
            <span class="float-right text-muted text-sm"></span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
            <i class="fas fa-sign-out-alt"></i> {{ __('Cerrar Sesion') }}
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <span class="float-right text-muted text-sm"></span>
          </a>
        </div>
      </li>
    </ul>
</nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  {{-- @include('layouts.partials.sidebar') --}}
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('admin.index') }}" class="brand-link">
    <img src="{{ url('images/logoKey.png') }}" width="50px" alt="Key Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light"><p></p></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        {{-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
      </div>
      <div class="info">
        <a href="{{ route('admin.index') }}" class="d-block">KEY - WMC</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <a href="{{ route('admin.index') }}" class="nav-link {{ setActiveRoute(['admin.index', 'home.index']) }}">
          <i class="fas fa-tachometer-alt nav-icon"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('exports.home') }}" class="nav-link {{ setActiveRoute('exports.home') }}">
          <i class="fas fa-file-export nav-icon"></i>
          <p>Reporte</p>
        </a>
      </li>
      @can('view', new App\Auditoria)
        <li class="nav-item">
          <a href="{{ route('admin.auditorias.index') }}" class="nav-link {{ setActiveRoute('admin.auditorias.index') }}">
            <i class="nav-icon far fa-clipboard"></i>
            <p>
              Planes de Accion
            </p>
          </a>
        </li>
      @endcan
      {{--
      <li class="nav-item">
        <a href="#" class="nav-link {{ setActiveRoute('admin.segmentos.status') }}">
          <i class="nav-icon fas fa-check-circle"></i>
          <p>
            Estatus de Acciones
          </p>
        </a>
      </li> --}}
    <li class="nav-header">Panel Avanzado</li>
    @can('view', new App\User)
      <li class="nav-item">
        <a href="{{ route('admin.users.index') }}" class="nav-link {{ setActiveRoute('admin.users.index') }}">
          <i class="nav-icon fas fa-users"></i>
          <p>
            Usuarios
          </p>
        </a>
      </li>
    @else
      <li class=" nav-item ">
        <a class="nav-link {{ setActiveRoute(['admin.users.edit', 'admin.users.show']) }}" href="{{ route('admin.users.edit', auth()->user()) }}">
          <i class="nav-icon fas fa-user"></i>
          <p>
            Perfil
          </p>
        </a>
      </li>
    @endcan
    @can('view', new App\GrupoMarca)
      <li class="nav-item">
        <a href="{{ route('admin.gruposm.index') }}" class="nav-link {{ setActiveRoute(['admin.gruposm.index', 'admin.gruposm.edit', 'admin.gruposm.create']) }}">
          <i class="nav-icon fas fa-users-cog"></i>
          <p>
            Grupos de Marcas
            <span class="badge badge-danger right"></span>
          </p>
        </a>
      </li>
    @endcan
    @can('view', new App\Marca)
      <li class="nav-item">
        <a href="{{ route('admin.marcas.index') }}" class="nav-link {{ setActiveRoute('admin.marcas.index') }}">
          <i class="nav-icon fab fa-bandcamp"></i>
          <p>
            Marcas
          </p>
        </a>
      </li>
    @endcan
    @can('view', new App\Sucursal)
      <li class="nav-item">
        <a href="{{ route('admin.sucursales.index') }}" class="nav-link {{ setActiveRoute('admin.sucursales.index') }}">
          <i class="nav-icon fas far fa-building"></i>
          <p>
            Sucursales
            <span class="badge badge-danger right"></span>
          </p>
        </a>
      </li>
    @endcan
    @can('view', new \Spatie\Permission\Models\Role)
        <li class="nav-header">Roles y Permisos</li>
        <li class="nav-item">
          <a href="{{ route('admin.roles.index') }}" class="nav-link {{ setActiveRoute('admin.roles.index') }}">
            <i class="nav-icon fas fa-user-tag"></i>
            <p>
              Roles
              <span class="badge badge-danger right"></span>
            </p>
          </a>
        </li>
    @endcan
    @can('view', new \Spatie\Permission\Models\Permission)
        <li class="nav-item">
          <a href="{{ route('admin.permissions.index') }}" class="nav-link {{ setActiveRoute('admin.permissions.index') }}">
            <i class="nav-icon fas fa-balance-scale-left"></i>
            <p>
              Permisos
              <span class="badge badge-danger right"></span>
            </p>
          </a>
        </li>
    @endcan
  </ul>
    </li>
  </ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{-- @yield('headertitle', '') --}}</h1>
          </div><!-- /.col -->
           <div class="col-sm-6">
            {{-- @yield('header') --}}
           </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      {{-- @include('layouts.alerts') --}}
      <div id="app">
        <router-view></router-view>
        {{-- <div class="container-fluid">
          <h5 class="mb-2">Bienvenido {{ Auth::user()->name }} | WMC</h5>
          @if (auth()->user()->hasRole('Admin'))
            <div class="row">
              <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-info">
                    <div class="inner">
                      @foreach ($gmarca as $g)
                        <h3>{{ $g->gmarca }}</h3>
                      @endforeach
                      <p>Grupo de Marca</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-layer-group"></i>
                    </div>
                    <a href="#" class="small-box-footer">Mas información<i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-primary">
                    <div class="inner">
                      @foreach ($marcas as $m)
                        <h3>{{ $m->marca }}</h3>
                      @endforeach
                      <p>Marcas</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-layer-group"></i>
                    </div>
                    <a href="{{ route('admin.marcas.index') }}" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-danger">
                    <div class="inner">
                      @foreach ($sucursales as $s)
                        <h3>{{ $s->sucursals }}</h3>
                      @endforeach
                      <p>Sucursales</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-layer-group"></i>
                    </div>
                    <a href="{{ route('admin.sucursales.index') }}" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <div class="col-lg-3 col-6">
                  <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    @foreach ($users as $user)
                      <h3>{{ $user->users }}</h3>
                    @endforeach
                    <p>Usuarios registrados</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <a href="{{ route('admin.users.index') }}" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          @elseif(auth()->user()->hasRole('ddistrital') || auth()->user()->hasRole('gzona') || auth()->user()->hasRole('gsucursal') || auth()->user()->hasRole('dregional') || auth()->user()->hasRole('dmarca'))
          @foreach ($sucursales->sucursals as $sucursale)
            <div class="row justify-content-center align-items-center minh-100" >
              <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                      <div class="info-box-content ">
                        @if ($sucursale->marcas->grupos->tipo == 'auditorias')
                          <img src="{{ url('marcas/'.$marca->photo) }}" alt="{{ $sucursale->marcas->name .'-'. $sucursale->marcas->id }}" width="300px" height="300" class="img-fluid">
                          @else
                            <a href="{{ route('home.region', $sucursale->marcas, Carbon\Carbon::now(), $dm ?? '') }}">
                            <img src="{{ url('marcas/'.$sucursale->marcas->photo) }}" alt="{{ $sucursale->marcas->name .'-'. $sucursale->marcas->id }}" width="300px" height="300" class="img-fluid">
                            </a>
                          @endif
                      </div>
                    </div>
                      @if ($sucursale->marcas->grupos->tipo == 'auditorias')
                      @if ($sucursale->marcas->puntuacion_general >= 90)
                            <a href="{{ route('home.region', $sucursale->marcas) }}"
                            class="btn btn-sm btn-success small-box-footer">
                              <i class="fas fa-star"></i> Calificacion de Limpieza:
                             <u>
                              {{ $sucursale->marcas->puntuacion_general }}
                             </u>
                            </a>
                          @elseif($sucursale->marcas->puntuacion_general >= 70)
                            <a href="{{ route('home.region', $sucursale->marcas) }}"
                            class="btn btn-sm btn-warning small-box-footer">
                              <i class="fas fa-exclamation-circle"></i> Calificacion de Limpieza:
                             <u>
                              {{ $sucursale->marcas->puntuacion_general }}
                             </u>
                            </a>
                        @elseif($sucursale->marcas->puntuacion_general < 70)
                            <a href="{{ route('home.region', $sucursale->marcas) }}"
                            class="btn btn-sm btn-danger small-box-footer">
                              <i class="fas fa-exclamation-triangle"></i> Calificacion de Limpieza:
                             <u>
                              {{ $sucursale->marcas->puntuacion_general }}
                             </u>
                            </a>
                        @endif
                        @endif
                </div>
                    <!-- /.info-box -->
                  </div>
              </div>
          @endforeach
          @elseif(auth()->user()->hasRole('dgral'))
            <div class="row justify-content-center align-items-center minh-100" >
                @foreach ($marcas as $marca)
                      <div class="col-md-3 col-sm-6 col-12">
                          <div class="info-box">
                            <div class="info-box-content ">
                              @if ($marca->grupos->tipo == 'auditorias')
                                <img src="{{ url('marcas/'.$marca->photo) }}" alt="{{ $marca->name .'-'. $marca->id }}" width="300px" height="300" class="img-fluid">
                                @else
                                  <a href="{{ route('home.region', $marca, Carbon\Carbon::now(), $dm ?? '') }}">
                                  <img src="{{ url('marcas/'.$marca->photo) }}" alt="{{ $marca->name .'-'. $marca->id }}" width="300px" height="300" class="img-fluid">
                                  </a>
                                @endif
                            </div>
                          </div>
                            @if ($marca->grupos->tipo == 'auditorias')
                            @if ($marca->puntuacion_general >= 90)
                                  <a href="{{ route('home.cedula', $marca) }}"
                                  class="btn btn-sm btn-success small-box-footer">
                                    <i class="fas fa-star"></i> Calificacion de Limpieza:
                                   <u>
                                    {{ $marca->puntuacion_general }}
                                   </u>
                                  </a>
                                @elseif($marca->puntuacion_general >= 70)
                                  <a href="{{ route('home.cedula', $marca) }}"
                                  class="btn btn-sm btn-warning small-box-footer">
                                    <i class="fas fa-exclamation-circle"></i> Calificacion de Limpieza:
                                   <u>
                                    {{ $marca->puntuacion_general }}
                                   </u>
                                  </a>
                              @elseif($marca->puntuacion_general < 70)
                                  <a href="{{ route('home.cedula', $marca) }}"
                                  class="btn btn-sm btn-danger small-box-footer">
                                    <i class="fas fa-exclamation-triangle"></i> Calificacion de Limpieza:
                                   <u>
                                    {{ $marca->puntuacion_general }}
                                   </u>
                                  </a>
                              @endif
                              @endif

                          <!-- /.info-box -->
                      </div>
                      <!-- /.col -->
              @endforeach
            </div>
          @endif --}}
          <!-- /.row -->
          </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a target="_blank" href="https://www.key.com.mx/">KEY</a>.</strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('adminLTE/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('adminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 4 -->
<script src="{{ asset('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('adminLTE/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('adminLTE/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
{{-- <script src="{{ asset('adminLTE/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> --}}
<!-- jQuery Knob Chart -->
{{-- <script src="{{ asset('adminLTE/plugins/jquery-knob/jquery.knob.min.js') }}"></script> --}}
<!-- daterangepicker -->
<script src="{{ asset('adminLTE/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('adminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('adminLTE/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
{{-- <script src="{{ asset('adminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script> --}}
<!-- AdminLTE App -->
<script src="{{ asset('adminLTE/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{ asset('adminLTE/js/pages/dashboard.js') }}"></script> --}}
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ asset('adminLTE/js/demo.js') }}"></script> --}}
{{-- <script src="{{ asset('js/app.js') }}"></script> --}}

@stack('scripts')
</script>
<script>
  //preLoading
  $(window).on('load', function () {
      setTimeout(function () {
    $(".loader-page").css({visibility:"hidden",opacity:"50"})
  }, 1);

});
</script>
 <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
