@extends('layouts.admin')
@section('content')
	 <div class="error-page">
        <h2 class="headline text-warning"> 404</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning"></i> Pagina no encontrada.</h3>

          <p>
            La pagina a la que intentas acceder no la pudimos encontrar.
            Puedes regresar al <a href="{{ route('home.index') }}">Inicio</a>.
          </p>
          <p>Si estas intentando descargar un archivo en formato <b>excel</b> lo mas seguro es que no tengas registros que coincidan con la busqueda, intenta ingresando otra fecha.
          	Intentar Exportar Nuevamente</p>

        </div>
        <!-- /.error-content -->
      </div>
@endsection