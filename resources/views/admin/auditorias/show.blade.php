@extends('layouts.admin')
@section('title', 'Key | Planes de Accion')
@section('headertitle', 'Listado de Segmentos')
@section('header')
@section('content')

<!-- Default box -->
<div class="card">
  <div class="col-md-12">
        <div class="row">
              <div class="col-md-6"></div>
            <div class="col-md-6">
                  <form action="" method="GET">
                        <h4>Filtros de busqueda</h4>
                        <div class="input-group">
                        <input class="form-control" id="datepicker" type="text" name="FechaRegistro" placeholder="Año y mes (YYY-mm)" autocomplete="off">
                              <select class="form-control" name="sucursal" id="">
                                    @foreach ($sucursales->sucursals as $sucursal)
                                          <option  {{ old('sucursal', request('sucursal')) == $sucursal->name ? 'selected' : ''}} value="{{ $sucursal->name }}">{{ $sucursal->name }}</option>
                                    @endforeach
                              </select>
                        <button class="btn btn-info">Consultar</button>
                        </div>
                  </form>
            </div>
        </div>

  </div>

  <div class="card-header">
    <h3 class="card-title"><b>{{ $auditoria->NombreAuditoria }}</b></h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fas fa-minus"></i></button>
    </div>
  </div>
  <div class="row">

    @foreach ($auditoria->segmentos as $segmento)
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
            <a href="{{ route('admin.segmentos.show', ['segmento' => $segmento->IdSegmentoAuditoria, 'FechaRegistro' => request('FechaRegistro'), 'sucursal' => request('sucursal') ]) }}">Mas Informacion...</a>
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