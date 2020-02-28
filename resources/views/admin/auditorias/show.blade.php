@extends('layouts.admin')
@section('title', 'Key | Planes de Accion')
@section('headertitle', 'Listado de Segmentos')
@section('header')
@section('content')
<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title"><b>{{ $auditoria->NombreAuditoria }}</b></h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fas fa-minus"></i></button>
    </div>
  </div>
  <div class="row">
    @foreach ($auditorias as $segmento)
      <div class="col-md-4">
        <div class="card card-outline card-primary">
          <div class="card-header">
            <h3 class="card-title">{{ $segmento->NombreSegmento }}</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
            </div>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <p>Fecha de Registro: <b>{{ $segmento->FechaRegistro }}</b> </p>
            <a href="{{ route('admin.segmentos.show', ['segmento' => $segmento->IdSegmentoAuditoria]) }}">Mas Informacion...</a>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    @endforeach
    <!-- /.col -->
  </div>
        <!-- /.row -->
  <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection