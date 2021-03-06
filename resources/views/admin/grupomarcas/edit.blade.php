@extends('layouts.admin')
@section('content')
@section('header')
<ol class="breadcrumb float-sm-right">
  <li class="breadcrumb-item"><a href="{{ route('admin.gruposm.index') }}">Grupos de Marca</a></li>
  <li class="breadcrumb-item active">Editar Grupo de Marca</li>
</ol>
@endsection
<div class="container-fluid">
	<div class="row">
    <div class="col-md-2"></div>
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
						<i class="fas fa-user"></i>
						Editar Grupo de la marca
					</h3>
				</div>
			<div class="card-body">
				<form method="POST" action="{{ route('admin.gruposm.update',  $gruposMarca->id) }}" enctype="multipart/form-data" class="form-horizontal">
					@csrf
          @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="" class="col-form-label">Nombre</label>
                    <small>*</small>
                    <div class="col-md-12">
                      <input type="text"
                      	class="form-control @error('name') is-invalid @else @enderror"
                      	placeholder="Grupo de la Marca..." name="name" value="{{ old('name', $gruposMarca->name) }}">
                      	@error('name')
	                        <span class="invalid-feedback" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                    @enderror
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="" class="col-form-label">Descripcion</label>
                    <div class="">
                      <textarea
                      name="description"
                      id="description"
                      cols="10"
                      rows="5"
                      class="form-control"
                      placeholder="Esta Parte es opcional">{{ old('description', $gruposMarca->description) }}</textarea>
                      <small class="text-muted">Opcional</small>
                      @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                    </div>
                  </div>
                  <div class="form-group ">
                      <div class="form-group">
                        <label for="exampleInputFile">Logo</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" name="logo" class="custom-file-input @error('logo') is-invalid @else border-1 @enderror" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Elige un logo...</label>
                          </div>
                          <div class="input-group-append">
                            <span class="input-group-text" id="">Imagen</span>
                          </div>
                        </div>
                      </div>
                        @error('logo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>
                  <div class="form-group">
                    <label>Nombre del Gerente General en curso</label>
                    <select name="user_id" class="form-control select2bs4" style="width: 100%;" required>
                      @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                          {{ old('user_id', $gruposMarca->user_id) == $user->id ? 'selected' : ''}}>{{ $user->name }}</option>
                      @endforeach
                    </select>
                        @error('user_id')
                          <div class="help-block">
                            <strong>{{ $message }}</strong>
                          </div>
                        @enderror
                  </div>
                  <div class="form-group">
                    <label>En esta Marca se realizara:</label>
                    <select disabled name="tipo" class="form-control select2" style="width: 100%;" required>
                        <option {{ old('tipo', $gruposMarca->tipo) == 'auditorias' ? 'selected' : ''}} value="auditorias">Auditorias</option>
                        <option {{ old('tipo', $gruposMarca->tipo) == 'cuestionarios' ? 'selected' : ''}} value="cuestionarios">Cuestionarios</option>
                    </select>
                    <small>*Verificar este campo</small>
                        @error('user_id')
                          <div class="help-block">
                            <strong>{{ $message }}</strong>
                          </div>
                        @enderror
                  </div>
              </div>
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
<script src="{{ asset('adminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  })

</script>
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
@endpush