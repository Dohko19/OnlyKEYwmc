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
				<form action="{{ route('exports.export') }}" method="GET">
					<div class="form-group">
						<div class="col-md-6">
							<label for="">Zona/Region</label>
							<select
							class="form-control select2bs4"
							name="zr"
							id="zr"
							style="width: 100%;">
								@foreach($region as $r)
									<option value="{{ $r->region }}">{{ $r->region }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-6">
							<label for="">Desde:</label>
							<input
							required
							id="datepickerfrom"
							type="text"
							name="from"
							class="form-control"
							placeholder=" Año Día, Mes"
							autocomplete="off">
						</div>
						<div class="col-md-6">
							<label for="">Hasta: </label>
							<input
							required
							id="datepickerto"
							type="text"
							name="to"
							class="form-control"
							placeholder="Día, Mes y Año"
							autocomplete="off">
						</div>
					</div>
						<button class="btn btn-primary">Consultar</button>
				</form>
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
  	<link rel="stylesheet" href="{{ asset('adminLTE/plugins/daterangepicker/daterangepicker.css') }}">

@endpush
@push('scripts')
	<script src="{{ asset('adminLTE/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('adminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
	<script src="{{ asset('adminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>

<script>
  $('#datepickerto').datepicker({
        autoclose: true,
        language: 'es',
        format: 'yyyy-mm-dd',
    });
  $('#datepickerfrom').datepicker({
        autoclose: true,
        language: 'es',
        format: 'yyyy-mm-dd',
    });

 $(function () {
    //Initialize Select2 Elements
    $('.select2bs4').select2to({
      theme: 'bootstrap4'
    })

    // $('#reservation').daterangepicker({
    // 	language: 'es',
    // 	locale: {
    //   		format: 'MM-DD ',
    //   		"applyLabel": "Aplicar",
	   //      "cancelLabel": "Cancelar",
	   //      "fromLabel": "Desde",
	   //      "toLabel": "Hasta",
	   //      "customRangeLabel": "Personalizado",
	   //      "daysOfWeek": [
	   //          "Do",
	   //          "Lu",
	   //          "Ma",
	   //          "Mi",
	   //          "Ju",
	   //          "Vi",
	   //          "Sa"
	   //      ],
	   //      "monthNames": [
	   //          "Enero",
	   //          "Febrero",
	   //          "Marzo",
	   //          "Abril",
	   //          "Mayo",
	   //          "Junio",
	   //          "Julio",
	   //          "Augosto",
	   //          "Septiembre",
	   //          "Octubre",
	   //          "Noviembre",
	   //          "Diciembre"
	   //      ],
	   //      "firstDay": 1,
    // 	}
    // })

  })
</script>
@endpush