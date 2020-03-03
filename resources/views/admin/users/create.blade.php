@extends('layouts.admin')
@section('content')
@section('header')
<ol class="breadcrumb float-sm-right">
  <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Usuarios</a></li>
  <li class="breadcrumb-item active">Crear Usuario</li>
</ol>
@endsection
<div class="container-fluid">
	<div class="row">
    <div class="col-md-4">
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
            Crear Usuario
          </h3>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('admin.users.store') }}" class="form-horizontal">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="" class="col-form-label">Nombre de Usuario</label>
                <small>El nombre de usuario se usara para iniciar sesion, recuerdalo si piensas cambiarlo.*</small>
                <div class="">
                  <input type="text"
                    class="form-control @error('name') is-invalid @else @enderror"
                    placeholder="Nombre de usuario..." name="name" value="{{ old('name') }}">
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
                    placeholder="Apellidos..." name="lastname" value="{{ old('lastname') }}">
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
                    placeholder="Telefono..." name="phone" value="{{ old('phone') }}">
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
                  <input class="form-control @error('email') is-invalid @else border-1 @enderror" name="email" type="email"  value="{{ old('email') }}" placeholder="E-mail..." />
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
                  <input class="form-control @error('password') is-invalid @else border-1 @enderror" name="password" id="registerPassword" type="password" placeholder="Contraseña" />
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
              <div class="form-group ">
                <label for="" class="col-form-label">Confirmar Contraseña</label>
                <div class="">
                  <input class="form-control" name="password_confirmation" id="registerPasswordConfirmation" type="password" equalTo="#registerPassword" placeholder="Confirma tu Contraseña" />
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
      <div class="col-md-4 col-lg-4">
        <div class="card card-primary card-outline">
          <div class="form-group col-md-12 {{ $errors->has('roles') ? 'has-error' : '' }}">
            <label for="">Roles</label>
            <select name="roles[]" class="form-control select2"
            multiple="multiple"
            data-placeholder="Selecciona uno o mas roles"
            style="width: 100%;">
            @foreach ($roles as $role)
              <option{{ $user->roles->contains($role->id) ? 'selected' : '' }} value="{{ $role->name }}">{{ $role->name }}</option>
            @endforeach
            </select>
            @error('roles')
              <div class="help-block">
                <strong>{{ $message }}</strong>
              </div>
            @enderror
          </div>
          <div class="form-group col-md-6">
            <label for="">Permisos</label>
            @include('admin.permissions.checkboxes', ['model' => $user  ])
          </div>
          <button class="btn btn-primary btn-block">Crear Usuario</button>
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
<script>
    $(".select2").select2({
        roles: true,
      });
  </script>
@endpush