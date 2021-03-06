@extends('layouts.admin')
@section('content')
@section('header')
<ol class="breadcrumb float-sm-right">
	<li class="breadcrumb-item"><a href="{{ route('admin.marcas.index') }}">Marcas</a></li>
	<li class="breadcrumb-item active">Inicio</li>
</ol>
@endsection
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card card-primary card-outline">
				<div class="card-header">
					<h3 class="card-title">
						<i class="fas fa-marcas"></i>
							Marcas
					</h3>
					@role('Admin')
						<a href="{{ route('admin.marcas.create') }}" class="btn btn-info float-right"><i class="fas fa-plus"></i> Crear Marca</a>
					@endrole
				</div>
			<div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Descripcion</th>
                  <th>Logo:</th>
                  <th>Creado el:</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                	@foreach($marcas as $marca)
                		<tr>
		                  <td>{{ $marca->id }}</td>
		                  <td>{{ $marca->name ?? 'Sin datos diposnibles'}}</td>
		                  <td>{{ $marca->description }}</td>
		                  <td><img src="{{ url('/marcas/'.$marca->photo) }}" alt="{{ $marca->id .'-'. $marca->name }}" width="100px"></td>
		                  <td>{{ $marca->created_at->format('Y-m-d') }}</td>
		                  <td>
		                  	@can('update', $marca)
			                  	<a class="btn" href="{{ route('admin.marcas.edit', $marca) }}" style="color: blue;"><i class="far fa-edit"></i></a>
		                  	@endcan
		                  	@can('delete', $marca)
		                  	<form
			                  	action="{{ route('admin.marcas.destroy', $marca) }}"
			                  	method="POST"
			                  	style="display: inline;">
                        		@csrf
                        		@method('DELETE')
			                  	<button class="btn "
			                  	onclick="return confirm('Estas seguro de Eliminar esta Marca?')"
			                  	><i class="fas fa-trash" style="color: red"></i></button>
	                        </form>
		                  	@endcan
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
