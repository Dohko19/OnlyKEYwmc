@extends('layouts.admin')
@section('title', 'Key | Planes de Accion')
@section('content')

<section class="content">
  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Segmento: <b>{{ $segmento->NombreSegmento }}</b> </h3>

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
                {{-- <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div> --}}
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Segmento</th>
                      <th>Plan de Accion</th>
                      <th>Imagen...</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($segmento->questions as $question)
                    <tr>
                      <td style="width: 600px;">
                        {{ $question->Pregunta }}
                      </td>
                      <td>
                        <form action="{{ route('admin.questions.update', $question) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group {{ $errors->has('comments') ? 'has-error' : '' }}">
                          <textarea
                          name="accion"
                          cols="30"
                          rows="3"
                          placeholder="Plan de accion...">{{ old('comments', $question->comments) }}</textarea>
                        </div>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Guardar</button>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-img-segmento">
                              Ver Imagen
                            </button>
                        </td>
                        </form>
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

          {{-- <a href="{{ route('admin.segmentos.status') }}"
          class="btn btn-danger float-right">Ir a Estado de Acciones</a> --}}
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
        @if (empty($question->photo))
        <p>Sin Imagen...</p>
        @else
        <p class="text-center"><img src="{{ url('/'.$question->photo) }} " alt="{{ $question->question ?? ''  }}"> </p>
        @endif
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>