@extends('layouts.admin')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 col-lg-12">
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-users"></i>
            Roles
          </h3>
        </div>
    <!-- /.box-header -->
    <div class="card-body">
          <a href="{{ route('admin.roles.create') }}" class="btn btn-primary float-right">
            <i class="fa fa-plus"> </i> Crear roles
          </a>
      <table id="roles-table" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th>ID</th>
          <th>Identificador</th>
          <th>Nombre</th>
          <th>Permisos</th>
          <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        	@foreach ($roles as $role)
				<tr>
					<td>{{ $role->id }}</td>
					<td>{{ $role->name }}</td>
          <td>{{ $role->display_name }}</td>
          <td>{{ $role->permissions->pluck('display_name')->implode(', ') }}</td>
					<td>
            <a href="{{ route('admin.roles.edit', $role) }}"
              class="btn btn-xs btn-info">
              <i class="fas fa-edit"></i>
            </a>
            @if ($role->id !== 1)
            <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" style="display: inline;">
              @csrf
              @method('DELETE')
						  <button class="btn btn-xs btn-danger"><i class="fa fa-times"
                onclick="return confirm('Estas seguro de Eliminar esta role?')"></i></button>
            </form>
            @endif
					</td>
				</tr>
        	@endforeach
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
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
    $('#roles-table').DataTable({
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