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
						Vista show de marcas
					</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-3">
							<img src="{{ url('marcas/'.$marca->photo) }}" alt="" width="300px">
						</div>
						<div class="col-md-9">
							<h2>Concentrado de Sucursales En</h2>
              @foreach ($sucursales as $sucursal)
              <b><u>{{ $sucursal->name }}</b></u>
                @foreach ($sucursal->questions as $squestion)
                  {{ $squestion->segmento }} <br>
                  @foreach ($squestion->answers as $sanswers)
                  {{ $sanswers->respuesta }} <br>
                  @endforeach
                @endforeach
              @endforeach
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
@push('scripts')
	<script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
 	<script src="https://code.highcharts.com/modules/drilldown.js"></script>
 	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/data.js"></script>
	<script src="https://code.highcharts.com/modules/drilldown.js"></script>
	<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

<script>
Highcharts.chart('container', {
  chart: {
    type: 'column'
  },
  title: {
    text: 'Sucursal {{ $marca->name }}'
  },
  subtitle: {
    text: 'Click en las columnas para ver la calificacion por areas.'
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
          name: "{{ $sucursal->name }}",
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
          [
            "INSTALACIONES Y ÁREAS",
            100
          ],
          [
            "EQUIPO Y UTENSILIOS",
            1.3
          ],
          [
            " <a href='#'> SERVICIOS</a> ",
            53.02
          ],
          [
            "ALMACENAMIENTO",
            1.4
          ],
          [
            "CONTROLES DE OPERACIÓN",
            0.88
          ],
          [
            "MATERIAS PRIMAS",
            0.1
          ],
          [
            "ENVASES",
            53.02
          ],
          [
            "AGUA EN CONTACTO CON LOS ALIMENTOS",
            2.6
          ],
          [
            "MANTENIMIENTO Y LIMPIEZA",
            1.3
          ],
          [
            "MANEJO DE RESIDUOS",
            4.3
          ],
          [
            "SALUD E HIGUIENE DEL PERSONAL",
            4.3
          ],
          [
            "TRANSPORTE",
            4.3
          ],
          [
            "DOCUMENTOS Y CAPACITACIÓN",
            4.3
          ]
        ]
      },
       @endforeach
    ]
  }
});
</script>
@endpush