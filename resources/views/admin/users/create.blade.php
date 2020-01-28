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
		<div class="col-md-4 col-lg-4">
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
                    <small>*</small>
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
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info btn-block">Crear</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card-body -->
			</div>
		</div>
	</div>
</div>
@endsection