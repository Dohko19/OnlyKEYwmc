@extends('layouts.admin')
@section('content')
@section('header')
<ol class="breadcrumb float-sm-right">
  <li class="breadcrumb-item">Panel de Control</li>
  <li class="breadcrumb-item active">Mostrar Marca</li>
</ol>
@endsection
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card card-primary card-outline">
				<div class="card-header">
					<h3 class="card-title">
						<i class="fab fa-buffer"></i>
						Resumen
					</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-3">
							<img src="{{ url('marcas/'.$marca->photo) }}" alt="" width="300px">
						</div>
						<div class="col-md-6">
							<h2>Concentrado de Sucursales en
                {{ $marca->name }}
             {{--  @foreach ($sucursales as $sucursal)
                {{ $sucursal->ciudad }}
              @endforeach --}}
            </h2>
						</div>
            <div class="col-md-3">
                <label for="graphic">Filtro por Fecha</label>
              <form action="{{ route('admin.marcas.show',$marca) }}" method="GET" class="form-inline">
                <input name="graphics" type="text" class="form-control pull-right" id="datepicker">
                <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                </button>
              </form>
            </div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="text-center">
								<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('styles')
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/datepicker/datepicker3.css') }}">
@endpush
@push('scripts')
	<script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/data.js"></script>
 	<script src="https://code.highcharts.com/modules/drilldown.js"></script>
 	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/data.js"></script>
	<script src="https://code.highcharts.com/modules/drilldown.js"></script>
	<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <script src="{{ asset('adminLTE/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script>
Highcharts.chart('container', {
  chart: {
    type: 'column'
  },
  title: {
    text: 'Marca {{ $marca->name }}'
  },
  subtitle: {
    text: 'Click en las columnas para ver la calificacion por sucursal.'
  },
  xAxis: {
    type: 'category'
  },
  yAxis: {
    title: {
      text: 'Calificaciones',
      title: 'Sucursales'
    }

  },
  legend: {
    enabled: false
  },
  plotOptions: {
    series: {
      borderWidth: 0,
      dataLabels: {
        enabled: true,
        format: '{point.y:.1f}%'
      }
    }
  },

  tooltip: {
    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> total<br/>'
  },

  series: [ //datos generales como el nombre de la marca
    {
      name: "SUCURSALES",
      colorByPoint: true,
      data: [
      @foreach ($sucursales as $sucursal)
        {
          name: "{{ $sucursal->name }} - {{ $sucursal->ciudad }}",
          y: {{ $sucursal->puntuacion_total }}, //calificacion en general
          drilldown: "{{ $sucursal->name }}"
        },
      @endforeach
      ]
    }
  ],
  drilldown: {
    series: [
        @foreach ($sucursales as $sucursal)
      {
        name: "{{ $sucursal->name }}",
        id: "{{ $sucursal->name }}",
        data: [
        @foreach ($sucursal->segmentos as $segmento)
          [
            "<a href='{{ route('admin.segmentos.edit', $segmento) }}'>{{ $segmento->segmento}}</a>",
            {{ $segmento->puntuacion }}
          ],
        @endforeach
        ]
      },
       @endforeach
    ]
  }
});
</script>
<script>
  $('#datepicker').datepicker({
        autoclose: true,
        language: 'es',
        format: 'yyyy-mm',
        viewMode: "months",
        minViewMode: "months"
      });

</script>
@endpush