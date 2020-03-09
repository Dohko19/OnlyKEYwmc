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
    <h5 class="mb-2">Listado de mis sucursales por Cedula </h5><br>
    @if (auth()->user()->hasRole('dmarca'))

    @else
    <div class="row justify-content-center align-items-center minh-100" >
      @foreach ($sucursales->sucursals as $s)
        <div class="col-md-3">
            <div class="card card-primary">
              <div class="card-header">
                Cedula:
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <a href="{{ route('admin.marcas.cedula', ['marca' => $s->m,'cedula' => $s->c]) }}">
              <div class="card-body">
               <b style="color: red;"><h4>{{ $s->c }}</h4></b><br>
                <img src="{{ url('/marcas/'.$marca->photo) }}" alt="{{ $marca->id .'-'. $marca->name }}" width="120px">
              <div class="timeline-footer">({{ $s->sucursals }})</div>
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