@extends('layouts.admin')
@section('content')
@section('header')
<ol class="breadcrumb float-sm-right">
  <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">WMC</a></li>
  <li class="breadcrumb-item active">Region</li>
</ol>
@endsection
<section class="content text-center" >
  <div class="container-fluid">
    <h5 class="mb-2">Listado de mis sucursales por zona </h5><br>
    @if ( auth()->user()->hasRole('gsucursal') || auth()->user()->hasRole('dmarca') )
     <div class="row justify-content-center align-items-center minh-100" >
      @foreach ($sucursales->sucursals as $s)
        <div class="col-md-3">
            <div class="card card-primary">
              <div class="card-header">
                Region:
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <a href="{{ route('admin.marcas.show', ['marca' => $s->m,'dm' => $s->dm, 'zone' => $s->r, 'zonaf' => $s->r ]) }}">
              {{-- <a href="{{ route('admin.marcas.show') }}"> --}}
              <div class="card-body">
               <b style="color: red;">{{ $s->r }}</b><br>
                <img src="{{ url('/marcas/'.$marca->photo) }}" alt="{{ $marca->id .'-'. $marca->name }}" width="150px">
              <div class="timeline-footer">({{ $s->sucursals }})</div>
              </div>
              </a>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
      </div>
      @endforeach
    </div>
    @elseif( auth()->user()->hasRole('dgral') )
    <div class="row justify-content-center align-items-center minh-100" >
      @foreach ($sucursales->sucursals as $s)
        <div class="col-md-3">
            <div class="card card-primary">
              <div class="card-header">
                Region:
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <a href="{{ route('admin.marcas.show', ['marca' => $s->m,'dm' => $s->dm, 'zone' => $s->r, 'zonaf' => $s->r ]) }}">
              {{-- <a href="{{ route('admin.marcas.show') }}"> --}}
              <div class="card-body">
               <b style="color: red;">{{ $s->r }}</b><br>
                <img src="{{ url('/marcas/'.$marca->photo) }}" alt="{{ $marca->id .'-'. $marca->name }}" width="150px">
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
      @if (auth()->user()->hasRole('Admin'))
          <div class="row justify-content-center align-items-center minh-100" >
              @foreach ($sucursales as $s)
                  <div class="col-md-3">
                      <div class="card card-primary">
                          <div class="card-header">
                              Region:
                              <!-- /.card-tools -->
                          </div>
                          <!-- /.card-header -->
                          <a href="{{ route('admin.marcas.show', ['marca' => $s->m,'dm' => $s->dm, 'zone' => $s->r, 'zonaf' => $s->r ]) }}">
                              {{-- <a href="{{ route('admin.marcas.show') }}"> --}}
                              <div class="card-body">
                                  <b style="color: red;">{{ $s->r }}</b><br>
                                  <img src="{{ url('/marcas/'.$marca->photo) }}" alt="{{ $marca->id .'-'. $marca->name }}" width="150px">
                                  <div class="timeline-footer">({{ $s->sucursals }})</div>
                              </div>
                          </a>
                          <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                  </div>
              @endforeach
              @foreach($mil as $m)
                      <div class="col-md-12">
                                  <!-- /.card-tools -->
                              </div>
                              <!-- /.card-header -->
                      <a href="{{ route('admin.marcas.show', ['marca' => $m->id]) }}">
                          <div class="info-box mb-3 bg-warning">
                              <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                              <div class="info-box-content">
                                  <span class="info-box-text">El Señor 10,000</span>
                                  <span class="info-box-number">El pasande del WMC</span>
                              </div>
                          </div>
                      </a>
                      </div>
              @endforeach
          </div>
      @endif
    <!-- /.row -->
</section>

@endsection
