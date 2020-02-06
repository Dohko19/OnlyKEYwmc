@extends('layouts.admin')
@section('title', 'Key | Panel de')
@section('headertitle', 'Panel de Accion')
@section('content')
<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Panel de accion: Activos</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fas fa-minus"></i></button>
    </div>
  </div>
  <div class="card-body p-0">
    <table class="table table-striped projects">
        <thead>
            <tr>
                <th style="width: 1%">
                    # Sucursal
                </th>
                <th style="width: 10%">
                    Nombre del Segmento
                </th>
                <th style="width: 50%">
                    Incidencias
                </th>
                <th>
                    Porcentaje
                </th>
                <th style="width: 4%" class="text-center">
                    Estado
                </th>
                <th style="width: 15%">Acciones
                </th>
            </tr>
        </thead>
        <tbody>
        	@foreach ( $segmentos as $segmento )
          @if (!$segmento->approved == 1)
            <tr>
                <td>
                  {{ $segmento->sucursals->id }}
                </td>
                <td>
                    <a>
                        {{ $segmento->segmento }}
                    </a>
                    <br/>
                    <small>
                        {{ $segmento->created_at->format('d/m/Y') }}
                    </small>
                </td>
                <td>
                  @foreach ( $segmento->questions as $question )
                    <ul class="">
                        <li class="">
                          {{ $question->question }}
                        </li>
                    </ul>
                  @endforeach
                </td>
                <td class="project_progress">
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-green" role="progressbar" aria-volumenow="57" aria-volumemin="0" aria-volumemax="100" style="width: {{ $segmento->puntuacion }}%">
                        </div>
                    </div>
                    <small>
                        {{ $segmento->puntuacion }}% Completado
                    </small>
                </td>
                <td class="project-state">
                  @if ($segmento->puntuacion < 50)
                    <span class="badge badge-danger">Aun no Atendido</span>
                  @elseif($segmento->puntuacion <= 99)
                    <span class="badge badge-warning">Pendiente</span>
                  @elseif($segmento->puntuacion == 100)
                    <span class="badge badge-success">OK</span>
                  @else
                    <span class="badge badge-default">Sin puntuacion</span>
                  @endif
                </td>
                <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.segmentos.show', $segmento) }}">
                        <i class="fas fa-folder">
                        </i>
                        Ver
                    </a>
                    <a class="btn btn-info btn-sm" href="{{ route('admin.segmentos.edit', $segmento) }}">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Editar
                    </a>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Panel de accion: Inactivos</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fas fa-minus"></i></button>
    </div>
  </div>
  <div class="card-body p-0">
    <table class="table table-striped projects">
        <thead>
            <tr>
                <th style="width: 1%">
                    # Sucursal
                </th>
                <th style="width: 10%">
                    Nombre del Segmento
                </th>
                <th style="width: 50%">
                    Incidencias
                </th>
                <th>
                    Porcentaje
                </th>
                <th style="width: 4%" class="text-center">
                    Estado
                </th>
                <th style="width: 15%">
                  Acciones
                </th>
            </tr>
        </thead>
        <tbody>
          @foreach ( $segmentos as $segmento )
          @if ($segmento->approved == 1)
            <tr>
                <td>
                  {{ $segmento->sucursals->id }}
                </td>
                <td>
                    <a>
                        {{ $segmento->segmento }}
                    </a>
                    <br/>
                    <small>
                        {{ $segmento->created_at->format('d/m/Y') }}
                    </small>
                </td>
                <td>
                  @foreach ( $segmento->questions as $question )
                    <ul class="">
                        <li class="">
                          {{ $question->question }}
                        </li>
                    </ul>
                  @endforeach
                </td>
                <td class="project_progress">
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-green" role="progressbar" aria-volumenow="57" aria-volumemin="0" aria-volumemax="100" style="width: {{ $segmento->puntuacion }}%">
                        </div>
                    </div>
                    <small>
                        {{ $segmento->puntuacion }}% Completado
                    </small>
                </td>
                <td class="project-state">
                  @if ($segmento->puntuacion < 50)
                    <span class="badge badge-danger">Aun no Atendido</span>
                  @elseif($segmento->puntuacion <= 99)
                    <span class="badge badge-warning">Pendiente</span>
                  @elseif($segmento->puntuacion == 100)
                    <span class="badge badge-success">OK</span>
                  @else
                    <span class="badge badge-default">Sin puntuacion</span>
                  @endif
                </td>
                <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.segmentos.show', $segmento) }}">
                        <i class="fas fa-folder">
                        </i>
                        Ver
                    </a>
                    <a class="btn btn-info btn-sm" href="{{ route('admin.segmentos.edit', $segmento) }}">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Editar
                    </a>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection