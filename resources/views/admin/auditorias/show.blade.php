@extends('layouts.admin')
@section('title', 'Key | Planes de Accion')
@section('headertitle', 'Listado de Segmentos')
@section('header')
@section('content')

<!-- Default box -->
<div class="card">
  <div class="col-md-12">
    <form action="" method="GET" class="float-right">
      <div class="form-group">
        <label for="FechaRegistro">Selecciona Año y Mes</label>
        <input class="form-control" id="datepicker" type="text" name="FechaRegistro" placeholder="Año y mes (YYY-mm)">
        <button class="btn btn-info">Consultar</button>
      </div>
    </form>
  </div>

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
@push('styles')
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/datepicker/datepicker3.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('adminLTE/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script>
  $('#datepicker').datepicker({
        autoclose: true,
        language: 'es',
        format: 'yyyy-mm',
        viewMode: "months",
        minViewMode: "months"
    });
</script>
@endpush