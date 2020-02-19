@extends('layouts.admin')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 col-lg-12">
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-user-tag"></i>
            Listado de Permisos
          </h3>
        </div>
      <div class="card-body">
              <table id="permisos-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Identificador</th>
                  <th>Nombre</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($permissions as $permission)
                <tr>
                  <td>{{ $permission->id }}</td>
                  <td>{{ $permission->name }}</td>
                  <td>{{ $permission->display_name }}</td>
                  <td>
                    <a href="{{ route('admin.permissions.edit', $permission) }}"
                      class="btn btn-xs btn-info">
                      <i class="fas fa-edit"></i>
                    </a>
                  </td>
                </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
      </div>
    </div>
  </div>
</div>
@endsection
@push('styles')
 <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush
@push('scripts')
<!-- DataTables -->
<script src="{{ asset('adminLTE/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script>
  $(function () {
    $('#permisos-table').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });
</script>

@endpush