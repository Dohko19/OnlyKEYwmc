@extends('layouts.admin')
@section('content')
@section('header')
<ol class="breadcrumb float-sm-right">
  <li class="breadcrumb-item">Panel de Control</li>
  <li class="breadcrumb-item active">Inicio</li>
</ol>
@endsection
<section class="content text-center" >
  <div class="container-fluid">
    <h5 class="mb-2">Listado de mis sucursales por zona </h5><br>
    @if (auth()->user()->hasRole('dmarca'))

    @else
    <div class="row justify-content-center align-items-center minh-100" >
      @foreach ($sucursales as $sucursale)
      <div class="col-md-3">
            <div class="card card-primary">
              <div class="card-header">
                Region:

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <a href="{{ route('admin.marcas.show', ['marca' => $sucursale->m,'dm' => $sucursale->dm, 'zone' => $sucursale->r, 'zonaf' => $sucursale->r ]) }}">
              <div class="card-body">
               <b style="color: red;">{{ $sucursale->r }}</b><br>
                <img src="{{ url('/marcas/'.$marca->photo) }}" alt="{{ $marca->id .'-'. $marca->name }}" width="150px">
              <div class="timeline-footer">({{ $sucursale->sucursals }})</div>
              </div>
              </a>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
      </div>
      @endforeach
    </div>
    @endif
    <!-- /.row -->
</section>

@endsection