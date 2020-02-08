@extends('layouts.admin')
@section('content')
@section('header')
<ol class="breadcrumb float-sm-right">
  <li class="breadcrumb-item">Panel de Control</li>
  <li class="breadcrumb-item active">Inicio</li>
</ol>
@endsection
<section class="content text-center" >
  <div class="container-fluid">
    <h5 class="mb-2">Marcas que le pertencen al Cliente | KEY</h5>
    <div class="row justify-content-center align-items-center minh-100" >
		@foreach ($grupos as $grupo)
			@foreach ($grupo->marcas as $marca)
				{{ $grupo }}
		      <div class="col-md-3 col-sm-6 col-12">
		        	<div class="info-box">
			          <div class="info-box-content">
			          	@if ($grupo->tipo == 'auditorias')
			          		<img src="{{ url('marcas/'.$marca->photo) }}" alt="{{ $marca->name .'-'. $marca->id }}" width="300px" height="300" class="img-fluid">
			          	@else
			          		<a href="{{ route('admin.marcas.show', $marca) }}">
			          		<img src="{{ url('marcas/'.$marca->photo) }}" alt="{{ $marca->name .'-'. $marca->id }}" width="300px" height="300" class="img-fluid">
			          		</a>
			          	@endif
			          </div>
		        	</div>
		        	@if ($grupo->tipo == 'auditorias')
		        	@if ($marca->puntuacion_general >= 90)
			          	<a href="{{ route('admin.marcas.show', $marca) }}"
			          	class="btn btn-sm btn-success small-box-footer">
			          		<i class="fas fa-star"></i> Calificacion de Limpieza:
			          	 <u>
			          	 	{{ $marca->puntuacion_general }}
			          	 </u>
			          	</a>
		          	@elseif($marca->puntuacion_general >= 70)
			          	<a href="{{ route('admin.marcas.show', $marca) }}"
			          	class="btn btn-sm btn-warning small-box-footer">
			          		<i class="fas fa-exclamation-circle"></i> Calificacion de Limpieza:
			          	 <u>
			          	 	{{ $marca->puntuacion_general }}
			          	 </u>
			          	</a>
			        @elseif($marca->puntuacion_general < 70)
			          	<a href="{{ route('admin.marcas.show', $marca) }}"
			          	class="btn btn-sm btn-danger small-box-footer">
			          		<i class="fas fa-exclamation-triangle"></i> Calificacion de Limpieza:
			          	 <u>
			          	 	{{ $marca->puntuacion_general }}
			          	 </u>
			          	</a>
		        	@endif
		        	@endif
		        	<!-- /.info-box -->
		      </div>
      		<!-- /.col -->
      		@endforeach
		@endforeach
    </div>
    <!-- /.row -->
</section>

@endsection