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
        <div class="form-group">
          <form action="{{ route('admin.segmentos.show', $segmento->IdSegmentoAuditoria) }}">
            <input id="datepicker" type="text" name="FechaRegistro" class="form-control" placeholder="Consultar por fecha de registro" value="{{ old('FechaRegistro', request('FechaRegistro')) }}">
            <button class="btn btn-outline-primary">Consultar</button>
          </form>
        </div>
      </div>
    </div>
    <div class="card-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Planes de Accion</h3>
                {{-- @foreach ($segmento1 as $segmento)
                  {{ $segmento->Pregunta }}
                @endforeach --}}
              </div>
              <div class="card-body">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th style="width: 33%">Preguntas Realizadas</th>
                      <th style="width: 15%">Comentario</th>
                      <th style="width: 10%">Imagen...</th>
                      <th style="width: 10%">Aprobado</th>
                    </tr>
                  </thead>
                  <tbody>
                     @foreach ($segmento1 as $segmento)
                    <tr>

                      <td style="width: 600px;">
                        {{ $segmento->Pregunta }}
                        <br><small><b>Fecha de Registro: {{ $segmento->FechaRegistro }}</b></small>
                        <br><small><b>Ultima Actualizacion: {{ $segmento->FechaActualizacion ?? 'Sin datos' }}</b></small>
                      </td>
                      <td>
                        <div class="form-group {{ $errors->has('comments') ? 'has-error' : '' }}">
                          <textarea
                          name="accion"
                          cols="30"
                          rows="5"
                          placeholder="Plan de accion..."
                          disabled>{{ old('comments', $segmento->Comentario) }}</textarea>
                        </div>
                        </td>
                        <td>
                          @if ($segmento->Foto)
                            <img id="myImg{{ $segmento->Id }}" src="{{ $segmento->Foto }}" width="150px" class="zoom" alt="">
                            {{-- <button type="button" class="btn btn-info openBtn">Open Modal</button> --}}
                          @else
                            <p>Sin Imagen</p>
                          @endif
                        </td>
                        <td>
                          <form action="{{ route('admin.resultados.update', $segmento->Id) }}"
                          method="POST" style="display: inline;">
                          @csrf
                          @method('PUT')
                            <select class="form-control" name="Aprobado">
                              <option value="0">No</option>
                              <option {{ $segmento->Id == 1 ? 'selected' : '' }} value="1">Si</option>
                            </select>
                              <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Guardar</button> <br>

                          </form>
                        </td>
                    </tr>
                     @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
</script>
@endpush
