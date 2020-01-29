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
				<div class="card-body pad table-responsive">
					<p>Marcas que pertenecen al cliente</p>
					<div class="col-lg-3 col-6">
						<div class="small-box bg-primary">
							<div class="inner">
								<h3></h3>
								<img src="marcas/5e30b9005e314-logo_liv.png" alt="">
							</div>
							<a href="#" class="small-box-footer">Calificacion de Limpieza: 10 <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
			</div>
		</div>
	</div>
</div>
@endsection