<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('admin.index') }}" class="brand-link">
    <img src="{{ url('images/key.png') }}" width="50px" alt="Key Logo" class="brand-image img-circle elevation-3"
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
          <li class="nav-item has-treeview {{ setActiveCollapse(['exports.home', 'export.auditoria']) }}">
            <a href="#" class="nav-link {{ setActiveRoute(['exports.home', 'export.auditoria']) }}">
              <i class="fas fa-ellipsis-h nav-icon"></i>
              <p>Reportes</p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview ">
              @if( auth()->user()->can('View reporte cuestionarios') )
                <li class="nav-item ">
                  <a href="{{ route('exports.home') }}" class="nav-link {{ setActiveRoute('exports.home') }}">
                    <i class="fas fa-file-export nav-icon"></i>
                    <p>Cuestionarios</p>
                  </a>
                </li>
              @endif
              @if( auth()->user()->hasPermissionTo('View reporte auditoria') )
                <li class="nav-item">
                  <a href="{{ route('export.auditoria') }}" class="nav-link {{ setActiveRoute('export.auditoria') }}">
                    <i class="fas fa-download nav-icon"></i>
                    <p>Auditorias</p>
                  </a>
                </li>
              @endif
               @if( auth()->user()->hasRole('dgral') || auth()->user()->hasRole('Admin') )
                  <li class="nav-item">
                      <a href="{{ route('export.chart') }}" class="nav-link {{ setActiveRoute('export.chart') }}">
                          <i class="fas fa-chart-pie nav-icon"></i>
                          <p>Detalle de mis sucursales</p>
                      </a>
                  </li>
                @endif
              @role('Admin')
                <li class="nav-item ">
                  <a href="{{ route('exports.home') }}" class="nav-link {{ setActiveRoute('exports.home') }}">
                    <i class="fas fa-file-export nav-icon"></i>
                    <p>Cuestionarios</p>
                  </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('export.auditoria') }}" class="nav-link {{ setActiveRoute('export.auditoria') }}">
                      <i class="fas fa-download nav-icon"></i>
                      <p>Auditorias</p>
                    </a>
                  </li>
              @endrole
            </ul>
          </li>
          @can('view', new App\Auditoria)
            <li class="nav-item">
              <a href="{{ route('admin.auditorias.show', 1) }}" class="nav-link {{ setActiveRoute('admin.auditorias.index') }}">
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
        @can('create', new App\GrupoMarca)
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
        @can('create', new App\Marca)
          <li class="nav-item">
            <a href="{{ route('admin.marcas.index') }}" class="nav-link {{ setActiveRoute('admin.marcas.index') }}">
              <i class="nav-icon fab fa-bandcamp"></i>
              <p>
                Marcas
              </p>
            </a>
          </li>
        @endcan
        @can('create', new App\Sucursal)
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
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
