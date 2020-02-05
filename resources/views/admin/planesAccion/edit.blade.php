@extends('layouts.admin')
@section('content')
@section('header')
<ol class="breadcrumb float-sm-right">
  <li class="breadcrumb-item"><a href="{{ route('admin.planes.index') }}">Planes de Accion</a></li>
  <li class="breadcrumb-item active">Plan de Accion</li>
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
            Plan de Accion
          </h3>
        </div>
      <div class="card-body">
        <form method="POST" action="" class="form-horizontal"
          enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <h1>In contruction...</h1>
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