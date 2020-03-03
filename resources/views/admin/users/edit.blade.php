@extends('layouts.admin')
@section('title', 'Key | Editar Perfil')
@section('content')
@section('header')
<ol class="breadcrumb float-sm-right">
  <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Usuarios</a></li>
  <li class="breadcrumb-item active">Editar Usuario</li>
</ol>
@endsection
<div class="container-fluid">
	<div class="row">
    <div class="col-md-6">
      <div class="card card-primary card-outline">
        <div class="card-header">
            @if ($errors->any())
              <ul class="list-group">
                @foreach ($errors->all() as $error)
                  <li class="list-group-item list-group-item-danger">
                    {{ $error }}
                  </li>
                @endforeach
              </ul>
           @endif
          <h3 class="card-title">
            <i class="fas fa-user"></i>
            Editar Usuario
          </h3>
        </div>
      <div class="card-body">
        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="form-horizontal">
          @csrf
          @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="" class="col-form-label">Nombre de Usuario</label>
                    <small>*</small>
                    <div class="">
                      <input type="text"
                        class="form-control @error('name') is-invalid @else @enderror"
                        placeholder="Nombre de usuario..." name="name" value="{{ old('name', $user->name) }}">
                        <small class="text-muted">El nombre de usuario se usara para iniciar sesion, recuerdalo si piensas cambiarlo.</small>
                        @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="" class="col-form-label">Apellidos</label>
                    <small>*</small>
                    <div class="">
                      <input type="text"
                        class="form-control @error('lastname') is-invalid @else @enderror"
                        placeholder="Apellidos..." name="lastname" value="{{ old('lastname', $user->phone) }}">
                        @error('lastname')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="" class="col-form-label">Telefono</label>
                    <small>*</small>
                    <div class="">
                      <input type="number"
                        class="form-control @error('phone') is-invalid @else @enderror"
                        placeholder="Telefono..." name="phone" value="{{ old('phone', $user->phone) }}">
                        @error('phone')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="" class="col-form-label">Email</label>
                    <div class="">
                      <input class="form-control @error('email') is-invalid @else border-1 @enderror" name="email" type="email"  value="{{ $user->email }}" placeholder="E-mail..." autocomplete="username"/>
                      @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                    </div>
                  </div>

                  <div class="form-group ">
                    <label for="" class="col-form-label">Contraseña</label>
                    <div class="">
                      <input class="form-control @error('password') is-invalid @else border-1 @enderror" name="password" id="registerPassword" type="password" placeholder="Contraseña" autocomplete="new-password"/>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <small class="text-muted">Si no quieres actualizar tu contraseña deja los campos vacios</small>
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="" class="col-form-label">Confirmar Contraseña</label>
                    <div class="">
                      <input class="form-control" name="password_confirmation" id="registerPasswordConfirmation" type="password" equalTo="#registerPassword" placeholder="Confirma tu Contraseña" autocomplete="new-password"/>
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                  </div>
                  @can('edit', $user)
                  <div class="form-group">
                   <label>Permisos de Usuario</label>
                    <select name="roles[]" class="form-control select2bs4" multiple="multiple" data-placeholder="Selecciona un Rol" style="width: 100%;" disabled>
                      @foreach ($roles as $id => $name)
                        <option
                        {{ $user->roles->pluck('id')->contains($id) ? 'selected' : '' }}
                        value="{{ $id }}">{{ $name }}</option>
                      @endforeach
                    </select>
                        @error('roles')
                          <div class="help-block">
                            <strong>{{ $message }}</strong>
                          </div>
                        @enderror
                    <small class="text-muted">Permisos de usuario</small>
                  </div>
                  @endcan
                </div>
                <!-- /.card-body -->
                <div class="">
                  <button type="submit" class="btn btn-info btn-block">Actualizar</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card-body -->
      </div>
    </div>
		<div class="col-md-6 col-lg-6">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Roles</h3>
          </div>
          <div class="card-body">
            @role('Admin')
            <form method="POST" action="{{ route('admin.users.roles.update', $user) }}">
              @csrf
              @method('PUT')

              @include('admin.roles.checkboxes')
              <button class="btn btn-primary btn-block">Actualizar Roles</button>
            </form>
            @else
            <ul class="list-group">
              @forelse ($user->roles as $role)
                <li class="list-group-item">{{ $role->display_name }}</li>
              @empty
                <li class="list-group-item">No tiene roles</li>
              @endforelse
            </ul>
            @endrole
          </div>
        </div>
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title">Permisos</h3>
      </div>
      <div class="card-body">
        @role('Admin')
        <form method="POST" action="{{ route('admin.users.permissions.update', $user) }}">
          @csrf
          @method('PUT')
          @include('admin.permissions.checkboxes', ['model' => $user])
          <button class="btn btn-primary btn-block">Actualizar permisos</button>
        </form>
        @else
          <ul class="list-group">
            @forelse ($user->permissions as $permission)
              <li class="list-group-item">{{ $permission->display_name }}</li>
            @empty
              <li class="list-group-item">No Tiene permisos</li>
            @endforelse
          </ul>
        @endrole
      </div>
		</div>
	</div>
</div>
@endsection
@push('styles')
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('adminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  })

</script>
@endpush