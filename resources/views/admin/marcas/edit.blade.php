@extends('layouts.admin')
@section('content')
@section('header')
<ol class="breadcrumb float-sm-right">
  <li class="breadcrumb-item"><a href="{{ route('admin.marcas.index') }}">Marcas</a></li>
  <li class="breadcrumb-item active">Editar Marca</li>
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
            Editar Marca
          </h3>
        </div>
      <div class="card-body">
        <form method="POST" action="{{ route('admin.marcas.update', $marca) }}" class="form-horizontal"
          enctype="multipart/form-data">
          @csrf
          @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="" class="col-form-label">Nombre de la marca</label>
                    <small>*</small>
                    <div class="">
                      <input type="text"
                        class="form-control @error('name') is-invalid @else @enderror"
                        placeholder="Nombre de usuario..."
                        name="name"
                        value="{{ old('name',$marca->name) }}">
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
                      <textarea class="form-control @error('description') is-invalid @else border-1 @enderror"
                      name="description" cols="30" rows="5" placeholder="Ingresa Alguna descipcion de la marca(puede quedar Vacio)">{{ old('description', $marca->description) }}</textarea>
                      @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                    </div>
                  </div>
                  <div class="form-group ">
                      <div class="form-group">
                        <label for="exampleInputFile">Foto/imagen de la Marca</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" name="photo" class="custom-file-input @error('photo') is-invalid @else border-1 @enderror" id="exampleInputFile" value="{{ $marca->photo }}">
                            <label class="custom-file-label" for="exampleInputFile">Elige una Imagen</label>
                          </div>
                          <div class="input-group-append">
                            <span class="input-group-text" id="">Imagen</span>
                          </div>
                        </div>
                      </div>
                        @error('photo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
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
@push('scripts')
  <script src="{{ asset('adminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
@endpush