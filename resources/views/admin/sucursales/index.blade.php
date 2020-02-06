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
                	@foreach ($sucursales as $sucursale)
                	@foreach ($sucursale->sucursales as $suc)
                		<tr>
		                  <td>{{ $suc->id }}</td>
		                  <td>{{ $suc->name ?? 'Sin datos diposnibles'}}</td>
		                  <td>{{ $suc->ciudad }}</td>
		                  <td>{{ $suc->puntuacion_total }}</td>
		                  <td>{{ $sucursale->name }}</td>
		                  <td>{{ $suc->created_at->format('d/m/Y') }}</td>
		                  <td>
			                  	<button
			                  	data-toggle="modal"
			                  	data-target="#modal-primary"
			                  	class="btn" href="#">
			                  	<i class="fas fa-eye" style="color: gray;"></i>
			                  	</button>
		                  	<form
			                  	action="{{ route('admin.sucursales.destroy', $suc) }}"
			                  	method="POST"
			                  	style="display: inline;">
                        		@csrf
                        		@method('DELETE')
			                  	<a class="btn" href="{{ route('admin.sucursales.edit', $suc) }}" style="color: #add8e6;"><i class="far fa-edit"></i></a>
			                  	<button class="btn "
			                  	onclick="return confirm('Estas seguro de Eliminar esta Sucursal?')"
			                  	><i class="fas fa-trash" style="color: red"></i></button>
	                        </form>
		                  </td>
                		</tr>
                	@endforeach
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
