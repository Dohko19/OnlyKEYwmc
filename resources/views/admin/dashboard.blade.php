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
		@foreach ($marcas as $marca)
	      <div class="col-md-3 col-sm-6 col-12">
	        	<div class="info-box">
		          <div class="info-box-content">
		          	<img src="{{ url('marcas/'.$marca->photo) }}" alt="{{ $marca->name .'-'. $marca->id }}" width="300px">
		          </div>
	          		<!-- /.info-box-content -->
	        	</div>
	          	<a href="{{ route('admin.marcas.show', $marca) }}" class="btn btn-sm btn-primary small-box-footer"><i class="fas fa-star"></i> Calificacion de Limpieza:
	          	 <u>{{ $marca->puntuacion_general }}</u></a>
	        	<!-- /.info-box -->
	      </div>
      		<!-- /.col -->
		@endforeach
    </div>
    <!-- /.row -->
</section>

@endsection