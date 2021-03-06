@extends('layouts.admin')
@section('title', 'Key | Panel de Accion')
@section('headertitle', '')
@section('content')
<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Panel de accion</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fas fa-minus"></i></button>
    </div>
  </div>
  <div class="card-body p-3" >
    <div class="row">
      @foreach ( $segmentos as $segmento )
        <div class="col-lg-4 col-8" style="color: #084b8a;" >
          <!-- small card -->
          <div class="small-box bg">
            <div class="inner">
              <h6 class="text-left"><b>{{ $segmento->NombreSegmento }}</b></h6>

              <p>Ultimo cambio el: someFecha</p>
              <p>De la sucursal:</p>
            </div>
            <div class="icon" style="color: #5882fa">
              <i class="fas fa-angle-right"></i>
            </div>
            <a style="color: white; background-color: #5882fa" }
            href="{{ route('admin.segmentos.show', $segmento) }}" class="small-box-footer">
              Mas informacion  <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

@endsection