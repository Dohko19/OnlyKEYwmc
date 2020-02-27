@extends('layouts.admin')
@section('content')
@section('header')
<ol class="breadcrumb float-sm-right">
	<li class="breadcrumb-item"><a href="{{ route('admin.sucursales.index') }}">Sucursales</a></li>
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
							Sucursales
					</h3>
					<a href="{{ route('admin.sucursales.create') }}" class="btn btn-info float-right"><i class="fas fa-plus"></i> Crear Sucursal</a>
				</div>
			<div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Ciudad</th>
                  <th>Puntuacion</th>
                  <th>De la marca</th>
                  <th>Creado el:</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                	@foreach($sucursales as $sucursale)
	                	@can('view', $sucursale)
	                		<tr>
			                  <td>{{ $sucursale->id }}</td>
			                  <td>{{ $sucursale->name }}</td>
			                  <td>{{ $sucursale->ciudad }}</td>
			                  <td>{{ $sucursale->zone }}</td>
			                  <td>{{ $sucursale->region }}</td>
			                  <td>{{ optional($sucursale)->created_at->format('Y-m-d') }}</td>
			                  <td>
			                  {{-- 	@can('view', $sucursale)
				                <a class="btn" href="{{ route('admin.sucursales.show', $sucursale) }}" style="color: blue;"><i class="far fa-eye"></i></a>
				                @endcan --}}
			                  	@can('update', $sucursale)
				                <a class="btn" href="{{ route('admin.sucursales.edit', $sucursale) }}" style="color: blue;"><i class="far fa-edit"></i></a>
				                @endcan
				                @can('delete', $sucursale)
				                  	<form action="{{ route('admin.sucursales.destroy', $sucursale) }}" method="POST" style="display: inline">
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
		    });
		});
</script>
@endpush
