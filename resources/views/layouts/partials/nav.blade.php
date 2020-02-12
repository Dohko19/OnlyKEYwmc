<nav class="main-header navbar navbar-expand navbar-blue navbar-dark">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('admin.index') }}" class="nav-link">WMC</a>
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
          <i class="fas fa-users mr-2"></i> {{ __('Cerrar Sesion') }}
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
          <span class="float-right text-muted text-sm"></span>
        </a>
      </div>
    </li>
  </ul>
</nav>