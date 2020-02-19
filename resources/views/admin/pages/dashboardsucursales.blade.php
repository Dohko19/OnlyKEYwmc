@extends('layouts.admin')
@section('content')
@section('header')
<ol class="breadcrumb float-sm-right">
  <li class="breadcrumb-item">Panel de Control</li>
  <li class="breadcrumb-item active">Sucursales</li>
</ol>
@endsection
<section class="content text-center" >
  <div class="container-fluid">
    <h5 class="mb-2">Mi listado de mis sucursales</h5>
    <div class="row justify-content-center align-items-center minh-100" >
			<div class="card-body">
	            <table id="example2" class="table table-bordered table-hover">
	                <thead>
		                <tr>
		                  <th>ID</th>
		                  <th>Nombre</th>
		                  <th>Ciudad</th>
		                  <th>Zona</th>
		                  <th>Region</th>
		                  <th>Delegacion/Municipio</th>
		                  <th>Creado el:</th>
		                  <th>Acciones</th>
		                </tr>
	                </thead>
	                <tbody>
	                	@foreach ($sucursales->sucursals as $sucursale)
	                	@can('view', $sucursale)
	                		<tr>
			                  <td>{{ $sucursale->id }}</td>
			                  <td>{{ $sucursale->name }}</td>
			                  <td>{{ $sucursale->ciudad }}</td>
			                  <td>{{ $sucursale->zone }}</td>
			                  <td>{{ $sucursale->region }}</td>
			                  <td>{{ $sucursale->delegacion_municipio ?? 'Sin Informacion'}}</td>
			                  <td>{{ optional($sucursale)->created_at->format('Y-m-d') }}</td>
			                  <td>
			                  	@can('view', $sucursale)
				                <a class="btn" href="{{ route('admin.sucursales.show', $sucursale) }}" style="color: blue;"><i class="far fa-eye"></i></a>
				                @endcan
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

    </div>
    <!-- /.row -->
</section>

@endsection