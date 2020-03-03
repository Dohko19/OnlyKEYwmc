@extends('layouts.admin')
@section('content')
	 <div class="error-page">
        <h2 class="headline text-warning">403</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning"></i> No tienes los suficientes permisos para ver esta pagina, contacta con el administrador del sitio o envia un correo a <a href="mailto:daniel.trejo@bennetts.com.mx">daniel.trejo@bennetts.com.mx</a></h3>

          <p>
            Regresar al <a href="{{ route('home.index') }}">Inicio</a>.
          </p>

        </div>
        <!-- /.error-content -->
      </div>
@endsection