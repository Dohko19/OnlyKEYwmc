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
    <h5 class="mb-2">Bienvenido {{ Auth::user()->name }} | WMC</h5><br>
    @if (auth()->user()->hasRole('dmarca'))

    @else
    <div class="row justify-content-center align-items-center minh-100" >
    	@foreach ($sucursales as $sucursale)
    	<div class="col-md-3 col-sm-6 col-12">
    		<a href="{{ route('admin.marcas.show', ['marca' => $sucursale->m,'dm' => $sucursale->dm, 'zone' => $sucursale->r ]) }}">
	        	<div class="info-box">
		          <div class="info-box-content ">
		          	Region: <br><b>{{ $sucursale->r }}</b> ({{ $sucursale->sucursals }}) <br><br>
		          	<h2><i style="color: gray;" class="fas fa-map-marked-alt"></i></h2>
		          </div>
	        	</div>
			</a>
		</div>
    	@endforeach
    </div>
    @endif
    <!-- /.row -->
</section>

@endsection