@extends('layouts.admin')
@section('content')
 <div class="error-page">
<h2 class="headline text-danger">500</h2>

<div class="error-content">
  <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Algo Salio Mal.</h3>

  <p>
    Estamos trabajando para solucionarlo de inmediato.
    Mienstras tanto, puedes <a href="{{ route('home.index') }}">regresar al inicio</a>
  </p>
</div>
</div>
@endsection