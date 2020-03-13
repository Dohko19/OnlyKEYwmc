@extends('layouts.admin')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card card-info card-outline">
				<div class="card-header">
					<h3 class="card-title">
					<i class="fas fa-file-download"></i> Elije una Opcion
					</h3>
				</div>
				<div class="card-body">
					<select name="select" id="inputSelect" class="form-control" required>
							<option selected value="1"><i class="far fa-file-pdf"></i> Reporte Excel</option>
							<option value="2">PDF</option>
					</select>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="divOculto" id="div1">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title">
							<i class="fas fa-download"></i>
							Reportes Excel de Auditoria
						</h3>
					</div>
				<div class="card-body">
					<form
					action="{{ route('exports.auditoria') }}"
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
									required>
										<option selected disabled>Elige Cedula</option>
										@foreach ($sucursales as $sucursal)
											<option value="{{ $sucursal->cedula }}">{{ $sucursal->cedula }}</option>
										@endforeach
									</select>
									<small>Selecciona Una region o zona</small>
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
								<button id="dwn" class="btn btn-primary">Descargar</button> &nbsp;&nbsp;
						</div>
					</form>
	            </div>
	            <!-- /.card-body -->
				</div>
			</div>
		</div>
	</div>
</div>
<div class="divOculto" id="div2">
	<div id="reporte" class="container-fluid">
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
										@foreach ($sucursales as $sucursal)
											<option value="{{ $sucursal->cedula }}">{{ $sucursal->cedula }}</option>
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
			                  <th>Cliente</th>
			                  <th>Cedula</th>
			                  <th>Sucursal</th>
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
</div>
@endsection
@push('styles')
	<link rel="stylesheet" href="{{ asset('adminLTE/plugins/datepicker/datepicker3.css') }}">
	<link rel="stylesheet" href="{{ asset('adminLTE/plugins/select2/css/select2.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('adminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

@endpush
@push('scripts')
	{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
	<script src="{{ asset('adminLTE/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('adminLTE/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
	$("#inputSelect").on('change', function() {

    var selectValue = $(this).val();
    switch (selectValue) {

      case "1":
        $("#div1").show();
        $("#div2").hide();
        break;

      case "2":
        $("#div1").hide();
        $("#div2").show();
        break;
    }

  }).change();

</script>

<script type="text/javascript">
	$(document).ready(function()
    {
			$('#pdf').click(function(event) {
		            event.preventDefault();
		            var dataString = $('#formulario').serialize();
		  	 $.ajax({
		  	 	url: '{{ route('exports.auditoria.pdf') }}',
		  	 	type: 'GET',
		  	 	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		  	 	data: dataString,
		        success: function(response, data){
		        	console.log(response);
		         	var valor = ''
		         	if (response.length == 0)
		         	{
		         		valor += "<tr>" +
		         		"<td colspan='9' style='text-align: center;'> No se encontraron resulados </td>" +
		         		"</tr>";
				      $("#DataResult").html(valor);
		         	}
		         	else
		         	{
		         	response.forEach(data => {
		            valor += '<tr>' +
				        '<td>' + data.id + '</td>' +
				        '<td>' + data.IdCte + '</td>' +
				        '<td>' + data.cedula + '</td>' +
				        '<td>' + data.name + '</td>' +
				        "<td><a target='_blank' href='http://appbennetts.com/VIC/ProcesosVIC8/ReportePDFCorreo.php?IdCedula="+data.IdCte+"&Division="+data.division+"'>Ver PDF</a></td>"+
				        "<td><a target='_blank' href='http://www.appbennetts.com/VIC/ProcesosVIC8/FlotanteCrearPDFVIC.php?IdCedula="+data.IdCte+"&Division="+data.division+"'>Descargar PDF</a></td>"+
				        '</tr>';
				    })
				      $("#DataResult").html(valor);
				    }
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