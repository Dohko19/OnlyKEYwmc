@extends('layouts.admin')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card card-primary card-outline">
				<div class="card-header">
					<h3 class="card-title">
						<i class="fas fa-users"></i>
						Usuarios
					</h3>
					@can('create', $users->first())
						<a href="{{ route('admin.users.create') }}" class="btn btn-info float-right"><i class="fas fa-plus"></i> Crear Usuario</a>
					@endcan
				</div>
			<div class="card-body">
	            <table id="example2" class="table table-bordered table-hover">
	                <thead>
		                <tr>
		                  <th>ID</th>
		                  <th>Nombre</th>
		                  <th>Email</th>
		                  <th>Acciones</th>
		                </tr>
	                </thead>
	                <tbody>
	                	@foreach ($users as $user)
	                	@can('view', $user)
	                		<tr>
			                  <td>{{ $user->id }}</td>
			                  <td>{{ $user->name }}</td>
			                  <td>{{ $user->email }}</td>
			                  <td>
			                  	@can('update', $user)
				                <a class="btn" href="{{ route('admin.users.edit', $user) }}" style="color: blue;"><i class="far fa-edit"></i></a>

								<form action="{{ route('admin.users.userdata', $user) }}" method="POST" style="display: inline;">
									@csrf
									<button class="btn"><i class="fas fa-envelope-square"></i></button>
								</form>
								<form action="{{ route('admin.users.resetpass', $user) }}" method="POST" style="display: inline;">
									@csrf
									<button class="btn"><i class="fas fa-sync-alt"></i></button>
								</form>
								@endcan
				                @can('delete', $user)
			                  	<form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline">
	                        		@csrf
	                        		@method('DELETE')
				                  	<button class="btn "
				                  	onclick="return confirm('Estas seguro de Eliminar este Usuario?')"
				                  	><i class="fas fa-trash" style="color: red"></i></button>
		                        </form>
		                        @endcan
			                  </td>
	                		</tr>
	                	@endcan
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
	<link rel="stylesheet" href="{{ asset('adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('adminLTE/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>

<script>
	$(function () {
	    $('#example2').DataTable({
	      "paging": true,
	      "lengthChange": true,
	      "searching": true,
	      "ordering": true,
	      "info": true,
	      "autoWidth": true,
	      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
	    });
		});
</script>
@endpush