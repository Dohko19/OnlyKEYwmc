@extends('layouts.admin')
@section('content')
@section('header')
<ol class="breadcrumb float-sm-right">
  <li class="breadcrumb-item">Panel de Control</li>
  <li class="breadcrumb-item active">Inicio</li>
</ol>
@endsection
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card card-primary card-outline">
				<div class="card-header">
					<h3 class="card-title">
						<i class="fab fa-buffer"></i>
						Inicio
					</h3>
				</div>
					<p>Marcas que pertenecen al cliente</p>
				<div class="row">
				@foreach ($marcas as $marca)
		          <div class="col-12 col-sm-6 col-md-3">
		            <div class="info-box">
						<a href="{{ route('admin.marcas.show', $marca) }}">
		                	<img src="{{ url('marcas/'.$marca->photo) }}" alt="{{ $marca->name .'-'. $marca->id }}" width="300px">
		                </a>
		              <div class="info-box-content">
		              </div>
		              <!-- /.info-box-content -->
		            </div>
		            <!-- /.info-box -->
		          </div>
		          <!-- /.col -->
		          <!-- fix for small devices only -->
		          <div class="clearfix hidden-md-up"></div>
				@endforeach
		        </div>
			</div>
		</div>
	</div>
</div>
@endsection