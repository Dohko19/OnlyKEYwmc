@extends('layouts.admin')
@section('content')
@section('header')
<ol class="breadcrumb float-sm-right">
  <li class="breadcrumb-item"><a href="{{ route('admin.sucursales.index') }}">Sucursales</a></li>
  <li class="breadcrumb-item active">Editar Sucursal</li>
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
            Editar Sucursal
          </h3>
        </div>
      <div class="card-body">
        <form method="POST" action="{{ route('admin.sucursales.update', $sucursale) }}" class="form-horizontal">
          @method('PUT')
          @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="" class="col-form-label">Nombre de la Sucursal</label>
                    <small>*</small>
                    <div class="">
                      <input required type="text"
                        class="form-control @error('name') is-invalid @else @enderror"
                        placeholder="Sucursal..." name="name" value="{{ old('name', $sucursale->name ) }}">
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
                      name="ciudad" placeholder="Ciudad" value="{{ $sucursale->name }}">
                      @error('ciudad')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                    </div>
                  </div>

                  <div class="form-group ">
                    <label for="" class="col-form-label">Ingresa el id del cliente</label>
                    <div class="">
                      <input required type="text" class="form-control @error('IdCte') is-invalid @else border-1 @enderror"
                      name="IdCte" placeholder="Cliente id" value="{{ old('IdCte', $sucursale->IdCte) }}">
                      @error('IdCte')
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
                        <option value="{{ $marca->id }}"
                          {{ old('marca_id', $sucursale->marca_id) == $marca->id ? 'selected' : ''}}>
                          {{ $marca->name }}</option>
                      @endforeach
                    </select>
                      @error('marca_id')
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
@push('scripts')
  <script src="{{ asset('adminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
@endpush