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
                    <label>Marca a la que pertenece</label>
                    <select name="marca_id" class="form-control select2" style="width: 100%;" required>
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
@endpush
@push('scripts')
  <script src="{{ asset('adminLTE/plugins/select2/js/select2.full.min.js') }}"></script>

<script type="text/javascript">
 $(function () {
  $('.select2').select2()
}
</script>
@endpush