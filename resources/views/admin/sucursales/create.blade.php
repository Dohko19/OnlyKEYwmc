@extends('layouts.admin')
@section('content')
@section('header')
<ol class="breadcrumb float-sm-right">
  <li class="breadcrumb-item"><a href="{{ route('admin.sucursales.index') }}">Sucursales</a></li>
  <li class="breadcrumb-item active">Crear Sucursal</li>
</ol>
@endsection
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 col-lg-12">
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
						<i class="fas fa-sliders-h"></i>
						Crear Sucursal
					</h3>
				</div>
			<div class="card-body">
				<form method="POST" action="{{ route('admin.sucursales.store') }}" class="form-horizontal">
					@csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="" class="col-form-label">Nombre de la Sucursal</label>
                    <small>*</small>
                    <div class="">
                      <input required type="text"
                      	class="form-control @error('name') is-invalid @else @enderror"
                      	placeholder="Sucursal..." name="name" value="{{ old('name') }}">
                      	@error('name')
	                        <span class="invalid-feedback" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                    @enderror
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="" class="col-form-label">Ciudad</label>
                    <div class="">
                      <input required type="text" class="form-control @error('ciudad') is-invalid @else border-1 @enderror"
                      name="ciudad" placeholder="Ciudad" value="{{ old('ciudad') }}">
                      @error('ciudad')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                    </div>
                  </div>
                   <div class="form-group">
                      <label for="" class="col-form-label">Región</label>
                      <small>*</small>
                      <div class="">
                        <input type="text"
                          class="form-control @error('region') is-invalid @else @enderror"
                          placeholder="Region..." name="region" value="{{ old('region') }}">
                          @error('region')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                   </div>
                    <div class="form-group">
                      <label for="" class="col-form-label">Zona</label>
                      <small>*</small>
                      <div class="">
                        <input type="text"
                          class="form-control @error('zone') is-invalid @else @enderror"
                          placeholder="Zona..." name="zone" value="{{ old('zone') }}">
                          @error('zone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                  <div class="form-group ">
                    <label for="" class="col-form-label">Ingresa el No. de cliente</label>
                    <div class="">
                      <input required type="text" class="form-control @error('IdCte') is-invalid @else border-1 @enderror"
                      name="IdCte" placeholder="Cliente id" value="{{ old('IdCte') }}">
                      @error('IdCte')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="" class="col-form-label">Ingresa el Telefono de la sucursal</label>
                    <div class="">
                      <input required type="text" class="form-control @error('phone') is-invalid @else border-1 @enderror"
                      name="phone" placeholder="Telefono de la Empresa" value="{{ old('phone') }}">
                      @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Marca a la que pertenece</label>
                    <select name="marca_id" class="form-control select2" style="height: 100%;" required>
                      @foreach ($marcas as $marca)
                        <option value="{{ $marca->id }}">{{ $marca->name }}</option>
                      @endforeach
                    </select>
                        @error('category_id')
                          <div class="help-block">
                            <strong>{{ $message }}</strong>
                          </div>
                        @enderror
                        <small class="text-muted">Necesitas agregar una marca para poder completar esta informacion</small>
                  </div>
                  <div class="form-group">
                        <div class="form-group">
                          <label>Selecciona a los usuarios quienes pueden ver esta sucursal</label>
                          <select name="users[]" class="duallistbox" multiple="multiple">
                            @foreach ($users as $user)
                              <option value="{{ $user->id }}">{{ $user->name }}/ {{ $user->email }}</option>
                            @endforeach
                          </select>
                        </div>
                        <!-- /.form-group -->
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
@push('styles')
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminLTE/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">

@endpush
@push('scripts')
  <script src="{{ asset('adminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
   <script src="{{ asset('adminLTE/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<script type="text/javascript">
 $(function () {
  $('.select2').select2()

  $('.duallistbox').bootstrapDualListbox()
})
</script>
@endpush