@extends('layouts.admin')
@section('title', 'Key | Planes de Accion')
@section('headertitle', 'Planes de Accion')
@section('content')
  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Lista de planes de accion faltantes</h3>
      {{-- @foreach ($paccions as $p)
        {{ $p->questions->sucursals }}
      @endforeach --}}
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="container-fluid">
          <h2 class="text-title"></h2>
          <br>
          <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Sucursal</th>
                      <th>Comentarios</th>
                      <th>Foto</th>
                      <th>Creado el:</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($paccions as $plane)
                      <tr>
                        <td>{{ $plane->questions->sucursals->name }}</td>
                        <td>{{ $plane->comments ?? 'Ningun Comentario' }}</td>
                        <td><img src="{{ url('$plane->photo') }}" alt="{{ $plane->id }}"></td>
                        <td>{{ $plane->created_at->format('m/Y') }}</td>
                        <td>
                          <form action="{{ route('admin.planes.destroy', $plane) }}" method="POST">
                              @csrf
                              @method('DELETE')
                            <a class="btn" href="{{ route('admin.sucursales.show', $plane->questions->sucursals->id) }}" style="color: #add8e6;"><i class="far fa-edit"></i></a>
                            <button class="btn "
                            onclick="return confirm('Estas seguro de Eliminar este Usuario?')"
                            ><i class="fas fa-trash" style="color: red"></i></button>
                            </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->
@endsection