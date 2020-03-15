@extends('layouts.admin')
@section('title', 'Key | Planes de Accion')
@section('content')
<section class="content">
  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"><b>
        Segmento: {{ $segmento->NombreSegmento }}</b></h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8"></div>
      <div class="col-md-4">
          <form action="{{ route('admin.segmentos.show', $segmento->IdSegmentoAuditoria) }}" style="display: inline;">
            <div class="form-group">
              <input type="hidden" name="sucursal" value="{{ request('sucursal') }}">
              <input id="datepicker"
                    type="text"
                    name="FechaRegistro"
                    class="form-control"
                    placeholder="Consultar por fecha de registro"
                    value="{{ old('FechaRegistro', request('FechaRegistro')) }}"
                    autocomplete="off">
              <button class="btn btn-outline-primary">Consultar</button>
            </div>
          </form>
      </div>
    </div>
    <div class="card-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Planes de Accion</h3>
              </div>
              <div class="card-body">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th style="width: 33%">Preguntas Realizadas</th>
                      <th style="width: 20%">Comentario</th>
                      <th style="width: 2%">Imagen...</th>
                      <th style="width: 23%">Aprobado y plan de acción</th>
                      <th style="width: 23%">Comentarios del D. General</th>
                    </tr>
                  </thead>
                  <tbody>
                     @foreach ($segmento1 as $seg)
                     @foreach ($seg->rauditoria as $s)
                      @if ($s->Aprobado == 0)
                        <tr>
                              <td style="width: 600px;">
                                    {{ $s->questions->Pregunta }}
                                    <br><small><b>Fecha de Registro: {{ $s->FechaRegistro }}</b></small>
                                    <br><small><b>Ultima Actualizacion: {{ $s->FechaActualizacion ?? 'Sin datos' }}</b></small>
                              </td>
                              <td>
                                    <div class="form-group {{ $errors->has('comments') ? 'has-error' : '' }}">
                                    <textarea
                                    cols="20"
                                    rows="5"
                                    class="form-control"
                                    placeholder="Plan de accion..."
                                    disabled>{{ old('comments', $segmento->Comentario) }}</textarea>
                                    </div>
                              </td>
                              <td>
                                    @if ($s->Foto)
                                    <img id="myImg{{ $segmento->Id }}" src="{{ $s->Foto }}" width="150px" class="zoom" alt="">
                                    @else
                                    <p>Sin Imagen</p>
                                    @endif
                              </td>
                              <td>
                                          <form action="{{ route('admin.resultados.update', $s->Id) }}"
                                          method="POST" style="display: inline;">
                                    <div class="form-group">
                                          @csrf
                                          @method('PUT')
                                          @can('update', new App\ResultadoAuditoria)
                                          @if (Carbon\Carbon::parse($s->FechaRegistro)->diffInHours() > 24)
                                            <select class="form-control"  disabled>
                                                  <option value="0">No</option>
                                                  <option {{ $s->Id == 1 ? 'selected' : '' }} value="1">Si</option>
                                            </select>
                                          @else
                                          <select class="form-control" name="Aprobado">
                                                  <option value="0">No</option>
                                                  <option {{ $s->Id == 1 ? 'selected' : '' }} value="1">Si</option>
                                            </select>
                                          @endif
                                          @endcan
                                          <textarea class="form-control" cols="30" rows="5" placeholder="Plan de Accion de parte del asesor" name="action">{{ old('action') }}</textarea>

                                    </div>
                              </td>
                              <td>
                                        @can('view', new App\ResultadoAuditoria)
                                        <textarea class="form-control" cols="30" rows="10" placeholder="Plan de accion de parte del director general" disabled>{{ old('action_dgral') }}</textarea>
                                        @endcan
                                        @role('dgral')
                                        <textarea name="action_dgral" class="form-control" cols="30" rows="5" placeholder="Plan de accion de parte del director general">{{ old('action_dgral') }}</textarea>
                                        @endrole
                                        <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Guardar</button> <br>
                                          </form>
                              </td>
                        </tr>
                      @endif
                     @endforeach
                     @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
            <div class="col-12">
                  <div class="card">
                        <div class="card-header">
                              <h3 class="card-title">Segmentos Aprobados</h3>
                        </div>
                        <div class="card-body">
                        <table class="table table-hover">
                              <thead>
                              <tr>
                                <th style="width: 33%">Preguntas Realizadas</th>
                                <th style="width: 20%">Comentario</th>
                                <th style="width: 2%">Imagen...</th>
                                <th style="width: 23%">Aprobado y plan de acción</th>
                                <th style="width: 23%">Comentarios del D. General</th>
                              </tr>
                              </thead>
                              <tbody>
                                 @foreach ($segmento1 as $seg)
                                   @foreach ($seg->rauditoria as $s)
                                    @if ($s->Aprobado == 1)
                                      <tr>
                                            <td style="width: 600px;">
                                                  {{ $s->questions->Pregunta }}
                                                  <br><small><b>Fecha de Registro: {{ $s->FechaRegistro }}</b></small>
                                                  <br><small><b>Ultima Actualizacion: {{ $s->FechaActualizacion ?? 'Sin datos' }}</b></small>
                                            </td>
                                            <td>
                                                  <div class="form-group {{ $errors->has('comments') ? 'has-error' : '' }}">
                                                  <textarea
                                                  cols="20"
                                                  rows="5"
                                                  class="form-control"
                                                  placeholder="Plan de accion..."
                                                  disabled>{{ old('comments', $segmento->Comentario) }}</textarea>
                                                  </div>
                                            </td>
                                            <td>
                                                  @if ($s->Foto)
                                                  <img id="myImg{{ $segmento->Id }}" src="{{ $s->Foto }}" width="150px" class="zoom" alt="">
                                                  @else
                                                  <p>Sin Imagen</p>
                                                  @endif
                                            </td>
                                            <td>
                                                        <form action="{{ route('admin.resultados.update', $s->Id) }}"
                                                        method="POST" style="display: inline;">
                                                  <div class="form-group">
                                                        @csrf
                                                        @method('PUT')
                                                        @can('update', new App\ResultadoAuditoria)
                                                        @if (Carbon\Carbon::parse($s->FechaRegistro)->diffInHours() > 24)
                                                          <select class="form-control"  disabled>
                                                                <option value="0">No</option>
                                                                <option {{ $s->Id == 1 ? 'selected' : '' }} value="1">Si</option>
                                                          </select>
                                                        @else
                                                        <select class="form-control" name="Aprobado">
                                                                <option value="0">No</option>
                                                                <option {{ $s->Id == 1 ? 'selected' : '' }} value="1">Si</option>
                                                          </select>
                                                        @endif
                                                        @endcan
                                                        <textarea class="form-control" cols="30" rows="5" placeholder="Plan de Accion de parte del asesor" name="action">{{ old('action') }}</textarea>

                                                  </div>
                                            </td>
                                            <td>
                                                      @can('view', new App\ResultadoAuditoria)
                                                      <textarea class="form-control" cols="30" rows="10" placeholder="Plan de accion de parte del director general" disabled>{{ old('action_dgral') }}</textarea>
                                                      @endcan
                                                      @role('dgral')
                                                      <textarea name="action_dgral" class="form-control" cols="30" rows="5" placeholder="Plan de accion de parte del director general">{{ old('action_dgral') }}</textarea>
                                                      @endrole
                                                      <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Guardar</button> <br>
                                                        </form>
                                            </td>
                                      </tr>
                                    @endif
                                   @endforeach
                                 @endforeach
                              </tbody>
                        </table>
                        </div>
                  </div>
            </div>
        </div>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->
</section>
<!-- The Modal -->


@endsection
@push('styles')
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/datepicker/datepicker3.css') }}">
  <style>
    img.zoom {
    width: 250px;
    height: 150px;
    -webkit-transition: all .2s ease-in-out;
    -moz-transition: all .2s ease-in-out;
    -o-transition: all .2s ease-in-out;
    -ms-transition: all .2s ease-in-out;
}

.transition {
    -webkit-transform: scale(1.8);
    -moz-transform: scale(1.8);
    -o-transform: scale(1.8);
    transform: scale(1.8);
}
  </style>
@endpush
@push('scripts')
  <script src="{{ asset('adminLTE/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
  <script>
$(document).ready(function(){
    $('.zoom').hover(function() {
        $(this).addClass('transition');
    }, function() {
        $(this).removeClass('transition');
    });
});
</script>

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
