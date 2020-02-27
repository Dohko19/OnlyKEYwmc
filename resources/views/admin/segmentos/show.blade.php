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
                      <th style="width: 15%">Comentario</th>
                      <th style="width: 10%">Imagen...</th>
                      <th style="width: 10%">Aprobado</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($segmento->questions as $question)
                    @foreach ($question->resultados as $resultado)
                    <tr>
                      <td style="width: 600px;">
                        {{ $question->Pregunta }}
                      </td>
                      <td>
                        <div class="form-group {{ $errors->has('comments') ? 'has-error' : '' }}">
                          <textarea
                          name="accion"
                          cols="30"
                          rows="5"
                          placeholder="Plan de accion..."
                          disabled>{{ old('comments', $resultado->Comentario) }}</textarea>
                        </div>
                        </td>
                        <td>
                          <img src="{{ $resultado->Foto }}" width="150px" alt="">
                        </td>
                        <td>
                          <form action="{{ route('admin.resultados.update', $resultado->Id) }}"
                          method="POST" style="display: inline;">
                          @csrf
                          @method('PUT')
                            <select class="form-control" name="Aprobado" id="Aprobado">
                              <option value="0">No</option>
                              <option {{ $resultado->Id == 1 ? 'selected' : '' }} value="1">Si</option>
                            </select>
                              <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Guardar</button> <br>

                          </form>
                        </td>
                    </tr>
                    @endforeach
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
@endsection
<div class="modal fade" id="modal-img-segmento">
  <div class="modal-dialog">
    <div class="modal-content bg-info">
      <div class="modal-header">
        <h4 class="modal-title">{{ $segmento->segmento }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        @foreach ($question->resultados  as $resultado)
        <p class="text-center"><img width="250px" src="{{ $resultado->Foto }} " alt="{{ $resultado->question ?? ''  }}"> </p>
        @endforeach
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>