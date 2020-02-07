<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('admin.index') }}" class="brand-link">
    <img src="{{ url('images/key.png') }}" width="50px" alt="Key Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">Key</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        {{-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
      </div>
      <div class="info">
        <a href="#" class="d-block">WHM</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="{{ route('admin.index') }}" class="nav-link {{ setActiveRoute('admin.index') }}">
                <i class="nav'icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
        @if(auth()->user()->isAdmin())
          <li class="nav-item">
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ setActiveRoute('admin.users.index') }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>
        @endif
        <li class="nav-item">
            <a href="{{ route('admin.segmentos.index') }}" class="nav-link {{ setActiveRoute('admin.segmentos.index') }}">
              <i class="nav-icon fab fa-gg-circle"></i>
              <p>
                Planes de Accion
              </p>
            </a>
          </li>
        <li class="nav-header">Root</li>
        <li class="nav-item">
          <a href="{{ route('admin.marcas.index') }}" class="nav-link {{ setActiveRoute('admin.marcas.index') }}">
            <i class="nav-icon fab fa-bandcamp"></i>
            <p>
              Marcas
              <span class="badge badge-danger right">new</span>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.sucursales.index') }}" class="nav-link {{ setActiveRoute('admin.sucursales.index') }}">
            <i class="nav-icon fas far fa-building"></i>
            <p>
              Sucursales
              <span class="badge badge-danger right"></span>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link {{ setActiveRoute('admin.sucursales.index') }}">
            <i class="nav-icon fas fa-users-cog"></i>
            <p>
              Grupos de Marcas
              <span class="badge badge-danger right"></span>
            </p>
          </a>
        </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>