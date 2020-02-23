@extends('layouts.admin')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card card-primary card-outline">
				<div class="card-header">
					<h3 class="card-title">
						<i class="fas fa-download"></i>
						Reportes
					</h3>
				</div>
			<div class="card-body">
				<form action="{{ route('exports.export') }}" method="GET" role="form" class="form-inline">
					<div class="form-group">
						<div class="row">
							<div class="col-md">
								<select
								class="form-control select2bs4"
								name="zr"
								id="zr"
								style="width: 100%;"
								>
									<option value="" selected disabled>Zona/Region</option>
									@foreach($region as $r)
										<option value="{{ $r->region }}">{{ $r->region }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md">
								<input
								required
								id="datepickerfrom"
								type="text"
								name="from"
								class="form-control"
								placeholder="Desde:"
								autocomplete="off">
							</div>
							<div class="col-md">
								<input
								required
								id="datepickerto"
								type="text"
								name="to"
								class="form-control"
								placeholder="Hasta:"
								autocomplete="off">
							</div>
						</div>
							<button class="btn btn-primary">Descargar</button> &nbsp;&nbsp;
					</div>
				</form>
            </div>
            <div id="reporte">
            	<reportes></reportes>
            </div>
            <!-- /.card-body -->
			</div>
		</div>
	</div>
</div>
@endsection
@push('styles')
	<link rel="stylesheet" href="{{ asset('adminLTE/plugins/datepicker/datepicker3.css') }}">
	<link rel="stylesheet" href="{{ asset('adminLTE/plugins/select2/css/select2.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('adminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@push('scripts')
	<script src="{{ asset('adminLTE/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('adminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
  $('#datepickerto').datepicker({
        autoclose: true,
        language: 'es',
        format: 'yyyy-mm',
        viewMode: "months",
        minViewMode: "months",
    });

  $('#datepickerfrom').datepicker({
        autoclose: true,
        language: 'es',
        format: 'yyyy-mm',
        viewMode: "months",
        minViewMode: "months"
    });
</script>

@endpush