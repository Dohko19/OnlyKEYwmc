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
					<div class="row">
						<div class="col-sm-3">
		                    <div class="position-relative p-3 bg-gray" style="height: 180px">
		                      <div class="ribbon-wrapper ribbon-lg">
		                        <div class="ribbon bg-info text-lg">
		                          Marca
		                        </div>
		                      </div>
		                      Imagen??
		                    </div>
		                    <small>Calificacion de Limpieza: <u>10</u></small>
		                </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection