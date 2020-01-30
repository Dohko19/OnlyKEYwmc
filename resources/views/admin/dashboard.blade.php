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
<<<<<<< HEAD
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

=======
					<div class="col-lg-3 col-6">
						<div class="small-box bg-primary">
							<div class="inner">
								<h3></h3>
								<img src="marcas/5e30b9005e314-logo_liv.png" alt="">
							</div>
							<a href="#" class="small-box-footer">Calificacion de Limpieza: 10 <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
>>>>>>> d85af56abd3e5be5a564346dfe9928f376bea8ad
			</div>
		</div>
	</div>
</div>
@endsection