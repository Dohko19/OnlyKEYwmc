@extends('layouts.admin')
@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card card-primary card-outline">
			<div class="card-header with-border">
				<h3 class="card-title">Actualizar Role<h3>
			</div>
			<div class="card-body">
					@include('layouts.alerts')
					<form action="{{ route('admin.roles.update', $role) }}" method="POST">
					@method('PUT')
						@include('admin.roles.form')
					<button class="btn btn-primary btn-block">Actualizar Role</button>
					</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('styles')
	<!-- Select2 -->
 	<link rel="stylesheet" href="{{ asset('adminLTE/plugins/select2/select2.min.css') }}">
@endpush
@push('scripts')
	<!-- Select2 -->
	<script src="{{ asset('adminLTE/plugins/select2/select2.full.min.js') }}"></script>
	<script>
		$(".select2").select2({
	    	roles: true,
	    });
	</script>
@endpush