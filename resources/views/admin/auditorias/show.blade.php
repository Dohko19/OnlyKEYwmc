@extends('layouts.admin')
@section('title', 'Key | Planes de Accion')
@section('header')
@endsection
@section('content')
<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title"><b>{{ $auditoria->NombreAuditoria }}</b></h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fas fa-minus"></i></button>
    </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
        <div class="row">
          <div class="col-6"></div>
          <div class="col-6">
            <h4>Auditorias por Segmento</h4>
            @foreach ($auditoria->segmentos as $segmento)
              <div class="post">
                <div class="user-block">
                  <span class="username">
                    <a href="#">{{ $segmento->NombreSegmento }}</a>
                  </span>
                  <span class="description">Fecha</span>
                </div>
                <!-- /.user-block -->
                <p>
                  <a href="#">Ver detalles de la auditoria por preguntas...</a>
                </p>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection