@extends('layouts.admin')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card card-primary card-outline">
				<div class="card-header">
					<h3 class="card-title">
						<i class="fas fa-users-cog"></i>
						Grupos de Marca
					</h3>
						<a href="{{ route('admin.gruposm.create') }}" class="btn btn-info float-right"><i class="fas fa-plus"></i> Crear Grupo de Marca</a>
				</div>
			<div class="card-body">
	            <table id="example2" class="table table-bordered table-hover">
	                <thead>
		                <tr>
		                  <th>ID</th>
		                  <th>Nombre</th>
		                  <th>Descripcion</th>
		                  <th>Logo</th>
		                  <th>Creado el:</th>
		                  <th>Acciones</th>
		                </tr>
	                </thead>
	                <tbody>
	                	@foreach ($grupomarcas as $grupoMarca)
	                		<tr>
			                  <td>{{ $grupoMarca->id }}</td>
			                  <td>{{ $grupoMarca->name }}</td>
			                  <td>{{ $grupoMarca->description }}</td>
			                  <td><img src="{{ url('grupomarcas/'.$grupoMarca->logo) }}" alt="" width="100px" height="100px"></td>
			                  <td>{{ $grupoMarca->created_at->format('d/m/Y') }}</td>
			                  <td>
			                  	<form action="{{ route('admin.gruposm.destroy', $grupoMarca) }}" method="POST">
	                        		@csrf
	                        		@method('DELETE')
				                  	<a class="btn" href="#"><i class="fas fa-eye" style="color: gray;"></i></a>
				                  	<a class="btn" href="{{ route('admin.gruposm.edit', $grupoMarca) }}" style="color: #add8e6;"><i class="far fa-edit"></i></a>
				                  	<button class="btn "
				                  	onclick="return confirm('Estas seguro de Eliminar este grupo de marca?')"
				                  	><i class="fas fa-trash" style="color: red"></i></button>
		                        </form>
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
	    });
		});
</script>
@endpush