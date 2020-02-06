@extends('layouts.admin')
@section('title', 'Key | Planes de Accion')
@section('headertitle', 'Plan de Accion')
@section('content')
<section class="content">
  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Planes de Accion para: <b>{{ $segmento->sucursals->name }}</b>
        de la marca <b>{{ $segmento->sucursals->marcas->name }}</b></h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="container-fluid ">
          <br>
          <table class="talbe text-center" style="margin: 0 auto;">
            @foreach ($segmento->questions as $question)
              @if (!$question->approved == 1)
                <tr>
                  <th>{{ $question->question }}</th>
                    <td>
                      <input size="32"
                      class="form-control"
                      disabled
                      name="comments"
                      type="text"
                      placeholder="Plan de accion..."
                      value="{{ old('comments', $question->comments) }}">
                    </td>
                  <td>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
                      Ver Imagen
                    </button>
                  </td>
                </tr>
              @endif
            @endforeach
          </table>
          <a href="{{ route('admin.segmentos.index') }}"
          class="btn btn-warning float-right">Volver atras</a>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->
</section>
@endsection
<div class="modal fade" id="modal-info">
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
        <p><img src="{{ url('question/'.$question->photo) }}" alt="{{ $question->question ?? ''  }}"> </p>
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