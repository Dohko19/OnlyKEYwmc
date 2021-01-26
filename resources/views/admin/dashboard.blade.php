@extends('layouts.admin')
@section('content')
@section('header')
<ol class="breadcrumb float-sm-right">
  <li class="breadcrumb-item">Panel de Control</li>
  <li class="breadcrumb-item active">Inicio</li>
</ol>
@endsection
<section class="content text-center" >
      <div>
  <div class="container-fluid" id="">
    <h5 class="mb-2">Bienvenido/a {{ Auth::user()->name }} | WMC</h5>
    @if (auth()->user()->hasRole('Admin'))
      <div class="row">
	    <div class="col-lg-3 col-6">
	        <!-- small box -->
	        <div class="small-box bg-info">
                  <div class="inner">
                  	@foreach ($gmarca as $g)
                  	<h3>{{ $g->gmarca }}</h3>
                  	@endforeach
                  <p>Grupo de Marca</p>
                  </div>
                  <div class="icon">
                  <i class="fas fa-layer-group"></i>
                  </div>
	          <a href="#" class="small-box-footer">Mas información<i class="fas fa-arrow-circle-right"></i></a>
	        </div>
	    </div>
	    <div class="col-lg-3 col-6">
	        <!-- small box -->
	        <div class="small-box bg-primary">
	          <div class="inner">
	          	@foreach ($marcas as $m)
	            	<h3>{{ $m->marca }}</h3>
	          	@endforeach
	            <p>Marcas</p>
	          </div>
	          <div class="icon">
	            <i class="fas fa-layer-group"></i>
	          </div>
	          <a href="{{ route('admin.marcas.index') }}" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
	        </div>
	    </div>
	    <div class="col-lg-3 col-6">
	        <!-- small box -->
	        <div class="small-box bg-danger">
	          <div class="inner">
	          	@foreach ($sucursales as $s)
	            	<h3>{{ $s->sucursals }}</h3>
	          	@endforeach
	            <p>Sucursales</p>
	          </div>
	          <div class="icon">
	            <i class="fas fa-layer-group"></i>
	          </div>
	          <a href="{{ route('admin.sucursales.index') }}" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
	        </div>
	    </div>
	    <div class="col-lg-3 col-6">
	        <!-- small box -->
		    <div class="small-box bg-warning">
		      <div class="inner">
		      	@foreach ($users as $user)
		        	<h3>{{ $user->users }}</h3>
		      	@endforeach
		        <p>Usuarios registrados</p>
		      </div>
		      <div class="icon">
		        <i class="ion ion-person-add"></i>
		      </div>
		      <a href="{{ route('admin.users.index') }}" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
		    </div>
	  	</div>
      </div>
          <hr>
        <div class="row justify-content-center align-items-center minh-100">
            @foreach($data as $data)
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <div class="info-box-content ">
                @if ($data->grupos->tipo == 'auditorias')
                    <a href="{{ route('home.cedula', $data) }}">
                        <img src="{{ url('marcas/'.$data->photo) }}" alt="{{ $data->name .'-'. $data->id }}" width="300px" height="300px" class="img-fluid">
                    </a>
                @else
                    <a href="{{ route('home.region', $data, Carbon\Carbon::now(), $dm ?? '') }}">
                        <img src="{{ url('marcas/'.$data->photo) }}" alt="{{ $data->name .'-'. $data->id }}" width="300px" height="300px" class="img-fluid">
                    </a>
                @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
	 @elseif(auth()->user()->hasRole('gzona') || auth()->user()->hasRole('gsucursal') || auth()->user()->hasRole('dmarca'))
		<div class="row justify-content-center align-items-center minh-100" >
      @foreach ($sucursales->sucursals->take(1) as $sucursale)
				<div class="col-md-3 col-sm-6 col-6">
		        	<div class="info-box">
			          <div class="info-box-content ">
			          	@if ($sucursale->marcas->grupos->tipo == 'auditorias')
			          		<img src="{{ url('marcas/'.$sucursale->marcas->photo) }}" alt="{{ $sucursale->marcas->name .'-'. $sucursale->marcas->id }}" width="300px" height="300" class="img-fluid">
                          @else
                            <a href="{{ route('home.region', $sucursale->marcas, Carbon\Carbon::now(), $dm ?? '') }}">
                                <img src="{{ url('marcas/'.$sucursale->marcas->photo) }}" alt="{{ $sucursale->marcas->name .'-'. $sucursale->marcas->id }}" width="300px" height="300" class="img-fluid">
                            </a>
                        @endif
			          </div>
		        	</div>
                    @if ($sucursale->marcas->grupos->tipo == 'auditorias')
                        @if ($sucursale->marcas->average)
                            @if ($sucursale->marcas->average->promedio >= 90)
                                        <a href="{{ route('home.cedula', $sucursale->marcas) }}"
                                        class="btn btn-sm btn-success small-box-footer">
                                            <i class="fas fa-star"></i> Calificacion de Limpieza:
                                        <u>
                                            {{ $sucursale->marcas->average->promedio ?? 'S/D' }}
                                        </u>
                                        </a>
                                    @elseif($sucursale->marcas->average->promedio >= 70)
                                        <a href="{{ route('home.cedula', $sucursale->marcas) }}"
                                        class="btn btn-sm btn-warning small-box-footer">
                                            <i class="fas fa-exclamation-circle"></i> Calificacion de Limpieza:
                                        <u>
                                            {{ $sucursale->marcas->average->promedio ?? 'S/D' }}
                                        </u>
                                        </a>
                                    @elseif($sucursale->marcas->average->promedio < 70)
                                        <a href="{{ route('home.cedula', $sucursale->marcas) }}"
                                        class="btn btn-sm btn-danger small-box-footer">
                                            <i class="fas fa-exclamation-triangle"></i> Calificacion de Limpieza:
                                        <u>
                                            {{ $sucursale->marcas->average->promedio ?? 'S/D' }}
                                        </u>
                                        </a>
                                    @else
                                        <a href="{{ route('home.cedula', $sucursale->marcas) }}"
                                        class="btn btn-sm btn-danger small-box-footer">
                                            <i class="fas fa-exclamation-triangle"></i> Calificacion de Limpieza:
                                            <u>
                                                Calculando...
                                            </u>
                                        </a>
                            @endif
                            @else
                                <a href="{{ route('home.cedula', $sucursale->marcas) }}"
                                    class="btn btn-sm btn-danger small-box-footer">
                                    <i class="fas fa-exclamation-triangle"></i> Calificacion de Limpieza:
                                    <u>
                                        Calculando...
                                    </u>
                                </a>
                        @endif
                    @endif
					</div>
                          <!-- /.info-box -->
       @endforeach
		</div>
      </div>
      @elseif(auth()->user()->hasRole('dgral'))
        <div class="row justify-content-center align-items-center minh-100" >
          @forelse ($marcas as $marca)
                          <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                <div class="info-box-content ">
                                  @if ($marca->grupos->tipo == 'cuestionarios')
                                        <a href="{{ route('home.region', $marca, Carbon\Carbon::now(), $dm ?? '') }}">
                                            <img src="{{ url('marcas/'.$marca->photo) }}" alt="{{ $marca->name .'-'. $marca->id }}" width="300px" height="300" class="img-fluid">
                                        </a>
                                        @else
                                            <img src="{{ url('marcas/'.$marca->photo) }}" alt="{{ $marca->name .'-'. $marca->id }}" width="300px" height="300" class="img-fluid">
                                  @endif
                                </div>
                                </div>
                                @if ($marca->grupos->tipo == 'auditorias')
                                @if ($sucursale->marcas->average)
                                    @if ($marca->average->promedio >= 90)
                                                      <a href="{{ route('home.cedula', $marca) }}"
                                                      class="btn btn-sm btn-success small-box-footer">
                                                            <i class="fas fa-star"></i> Calificacion de Limpieza:
                                                      <u>
                                                            {{ $marca->average->promedio ?? 'S/D' }}
                                                      </u>
                                                      </a>
                                          @elseif($marca->average->promedio >= 70)
                                                <a href="{{ route('home.cedula', $marca) }}"
                                                class="btn btn-sm btn-warning small-box-footer">
                                                      <i class="fas fa-exclamation-circle"></i> Calificacion de Limpieza:
                                                <u>
                                                      {{ $marca->average->promedio ?? 'S/D' }}
                                                </u>
                                                </a>
                                          @elseif($marca->average->promedio < 70)
                                                <a href="{{ route('home.cedula', $marca) }}"
                                                class="btn btn-sm btn-danger small-box-footer">
                                                      <i class="fas fa-exclamation-triangle"></i> Calificacion de Limpieza:
                                                <u>
                                                      {{ $marca->average->promedio ?? 'S/D' }}
                                                </u>
                                                </a>
                                          @endif
                                          @else
                                            <a href="{{ route('home.cedula', $sucursale->marcas) }}"
                                                class="btn btn-sm btn-danger small-box-footer">
                                                <i class="fas fa-exclamation-triangle"></i> Calificacion de Limpieza:
                                                <u>
                                                    Calculando...
                                                </u>
                                            </a>

                                    @endif
                                    @endif
                          </div>
                          <!-- /.col -->
                        @empty
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <div class="info-box-content ">
                      <a href="{{ route('home.region', $marca, Carbon\Carbon::now(), $dm ?? '') }}">
                      <img src="{{ url('marcas/'.$marca->photo) }}" alt="{{ $marca->name .'-'. $marca->id }}" width="300px" height="300" class="img-fluid">
                      </a>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
      @elseif(auth()->user()->hasRole('ddistrital'))
        <div class="row justify-content-center align-items-center minh-100" >
      @foreach ($sucursales->sucursals->take(1) as $sucursale)
        <div class="col-md-3 col-sm-6 col-6">
              <div class="info-box">
                <div class="info-box-content ">
                  @if ($sucursale->marcas->grupos->tipo == 'auditorias')
                    <img src="{{ url('marcas/'.$sucursale->marcas->photo) }}" alt="{{ $sucursale->marcas->name .'-'. $sucursale->marcas->id }}" width="300px" height="300" class="img-fluid">
                @else
                                        <a href="{{ route('home.region', $sucursale->marcas, Carbon\Carbon::now(), $dm ?? '') }}">
                                        <img src="{{ url('marcas/'.$sucursale->marcas->photo) }}" alt="{{ $sucursale->marcas->name .'-'. $sucursale->marcas->id }}" width="300px" height="300" class="img-fluid">
                                        </a>
                @endif
                </div>
              </div>
                @if ($sucursale->marcas->grupos->tipo == 'auditorias')
                    @if ($sucursale->marcas->average)
                    @if ($sucursale->marcas->average->promedio >= 90)

                        <a href="{{ route('home.cedula', $sucursale->marcas) }}"
                        class="btn btn-sm btn-success small-box-footer">
                            <i class="fas fa-star"></i> Calificacion de Limpieza:
                        <u>
                            {{ $sucursale->marcas->average->promedio ?? 'S/D' }}
                        </u>
                        </a>
                        @elseif($sucursale->marcas->average->promedio >= 70)
                        <a href="{{ route('home.cedula', $sucursale->marcas) }}"
                        class="btn btn-sm btn-warning small-box-footer">
                            <i class="fas fa-exclamation-circle"></i> Calificacion de Limpieza:
                        <u>
                            {{ $sucursale->marcas->average->promedio ?? 'S/D' }}
                        </u>
                        </a>
                    @elseif($sucursale->marcas->average->promedio < 70)
                        <a href="{{ route('home.cedula', $sucursale->marcas) }}"
                        class="btn btn-sm btn-danger small-box-footer">
                            <i class="fas fa-exclamation-triangle"></i> Calificacion de Limpieza:
                        <u>
                            {{ $sucursale->marcas->average->promedio ?? 'S/D' }}
                        </u>
                        </a>
                    @else
                        <a href="{{ route('home.cedula', $marca) }}"
                        class="btn btn-sm btn-danger small-box-footer">
                            <i class="fas fa-exclamation-triangle"></i> Calificacion de Limpieza:
                            <u>
                                Calculando...
                            </u>
                        </a>
                    @endif
                    @else
                        {{-- <a href="{{ route('home.cedula', $sucursale->marcas) }}"
                        class="btn btn-sm btn-danger small-box-footer">
                            <i class="fas fa-exclamation-triangle"></i> Calificacion de Limpieza: <u>Calculando</u>
                        </a> --}}
                    @endif

                  @endif
          </div>
                          <!-- /.info-box -->
                        @endforeach
    </div>
          @elseif(auth()->user()->hasRole('asesor'))

          @endif
    <!-- /.row -->

      </div>
</section>
@endsection
