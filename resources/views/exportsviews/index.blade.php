@extends('layouts.admin')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card card-primary card-outline">
				<div class="card-header">
					<h3 class="card-title">
						<i class="fas fa-download"></i>
						Reportes Excel
					</h3>
				</div>
			<div class="card-body">
				<form
				action="{{ route('exports.export') }}"
				{{-- action="javascript:getexport();" --}}
				method="GET"
				id="reportget"
				role="form"
				class="form-inline">
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
								id="from"
								type="text"
								name="from"
								class="form-control"
								placeholder="Desde:"
								autocomplete="off">
							</div>
							<div class="col-md">
								<input
								required
								id="to"
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
            <!-- /.card-body -->
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card card-primary card-outline">
				<div class="card-header">
					<h3 class="card-title">
						<i class="fas fa-download"></i>
						Reportes PDF
					</h3>
				</div>
			<div class="card-body">
				<form
				action="{{ route('exports.pdf') }}"
				{{-- action="javascript:getexport();" --}}
				method="GET"
				id="formulario"
				role="form"
				class="form-inline">
					<div class="form-group">
						<div class="row">
							<div class="col-md">
								<select
								class="form-control select2bs4"
								name="zrp"
								id="zrp"
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
								id="desdep"
								type="text"
								name="desdep"
								class="form-control"
								placeholder="Desde:"
								autocomplete="off">
							</div>
							<div class="col-md">
								<input
								required
								id="hastap"
								type="text"
								name="hastap"
								class="form-control"
								placeholder="Hasta:"
								autocomplete="off">
							</div>
						</div>
							<button id="pdf" class="btn btn-primary">Descargar</button> &nbsp;&nbsp;
					</div>
				</form>
            </div>
            <!-- /.card-body -->
			</div>
			<div class="card-body">
             	<table class="table table-bordered table-hover">
	                <thead>
		                <tr>
		                  <th>ID</th>
		                  <th>ID Cliente</th>
		                  <th>ID region</th>
		                  <th>Sucursal</th>
		                  <th>Delegacion/Municipio</th>
		                  <th>Ciudad</th>
		                  <th>Created_at</th>
		                  <th>Ver PDF</th>
		                  <th>Descargar</th>
		                </tr>
	                </thead>
	                <tbody id="DataResult">
	                </tbody>
	            </table>
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
<script type="text/javascript">
	$(document).ready(function()
    {
			$('#pdf').click(function(event) {
		            event.preventDefault();
		            var dataString = $('#formulario').serialize();
		  	 $.ajax({
		  	 	url: '{{ route('exports.pdf') }}',
		  	 	type: 'GET',
		  	 	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		  	 	data: dataString,
		         success: function(data){
		         	var valor = ''
		         	data.forEach(data => {
		            valor += '<tr>' +
				        '<td>' + data.id + '</td>' +
				        '<td>' + data.IdCte + '</td>' +
				        '<td>' + data.region + '</td>' +
				        '<td>' + data.name + '</td>' +
				        '<td>' + data.ciudad + '</td>' +
				        '<td>' + data.delegacion_municipio + '</td>' +
				        '<td>' + data.created_at + '</td>' +
				        "<td><a target='_blank' href='http://appbennetts.com/VIC/ProcesosVIC8/ReportePDFCorreo.php?IdCedula="+data.IdCte+"&Division=0'>Ver PDF</a></td>"+
				        "<td><a target='_blank' href='http://www.appbennetts.com/VIC/ProcesosVIC8/FlotanteCrearPDFVIC.php?IdCedula="+data.IdCte+"&Division=0'>Descargar PDF</a></td>"+
				        '</tr>';
				    })
				      $("#DataResult").html(valor);
		            }, error:function(jqXHR, textStatus, errorThrown){
		                console.log('error::'+errorThrown);
		                 console.log('error::'+textStatus);
		                  console.log('error::'+jqXHR);
		               }

		        });
		  	});
  	   });
</script>

<script>
	  $('#desdep').datepicker({
        autoclose: true,
        language: 'es',
        format: 'yyyy-mm',
        viewMode: "months",
        minViewMode: "months",
    });
	  $('#hastap').datepicker({
        autoclose: true,
        language: 'es',
        format: 'yyyy-mm',
        viewMode: "months",
        minViewMode: "months",
    });


</script>
<script>
  $('#to').datepicker({
        autoclose: true,
        language: 'es',
        format: 'yyyy-mm',
        viewMode: "months",
        minViewMode: "months",
    });

  $('#from').datepicker({
        autoclose: true,
        language: 'es',
        format: 'yyyy-mm',
        viewMode: "months",
        minViewMode: "months"
    });


</script>

@endpush