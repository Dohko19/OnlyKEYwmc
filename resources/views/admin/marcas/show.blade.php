@extends('layouts.admin')
@section('content')
@section('headertitle', '')
@section('title', 'Key | Mis Sucursales')

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
							<img src="{{ url('marcas/'.$marca->photo) }}" alt="" width="100px" height="100px">
						</div>
						<div class="col-md-6">
							<h2 class="text-center">
                {{ $marca->name }}
              </h2>
              <p class="text-center">Calificación de auditoria por sucursal <br>
              <a class="text-center" href="{{ route('pages.planes') }}">Ver Planes de Acción</a></p>
						</div>
            <div class="col-md-3">
                <label for="graphic">Filtro por Fecha</label>
              <form action="{{ route('admin.marcas.show',$marca) }}" method="GET" class="form-inline">
                <input name="graphics" type="text" class="form-control pull-right" id="datepicker" placeholder="Elige un mes y año" autocomplete="off">
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
                <small class="text-muted"></small>
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
  <script src="http://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <script src="{{ asset('adminLTE/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
{{-- <script>
Highcharts.chart('container', {
  chart: {
    type: 'column',
    events: {
            load: function () {
                var label = this.renderer.label("*Click en el nombre para ver plan de accion")
                .css({
                    width: '400px',
                    fontSize: '13px'
                })
                .attr({
                    'stroke': 'silver',
                    'stroke-width': 1,
                    'r': 2,
                    'padding': 5
                })
                .add();

                label.align(Highcharts.extend(label.getBBox(), {
                    align: 'center',
                    x: 20, // offset
                    verticalAlign: 'bottom',
                    y: 0 // offset
                }), null, 'spacingBox');

            }
        },
        marginBottom: 120,
    inverted: false,
    scrollablePlotArea: {
            minWidth: 700,
            scrollPositionX: 1
        },
    },
    title: {
      text: ''
    },
    subtitle: {
      text: 'Click en las columnas para ver la calificacion por sucursal.'
    },
    accessibility: {
          announceNewData: {
              enabled: true
          }
      },
    xAxis: {
      type: 'category'
    },
    yAxis: {
      title: {
        text: 'Calificaciones',
        title: 'Sucursales'
      },
       min: 0,
       max: 100,
    },
    legend: {
      enabled: false,
    },
    credits: {
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
      drillUpButton: {
        position: {
            x: -30,
            y: -40,
        }
    },
      series: [
          @foreach ($sucursales as $sucursal)
        {
          name: "{{ $sucursal->name }}",
          id: "{{ $sucursal->name }}",
          data: [
          @foreach ($sucursal->segmentos as $segmento)
            [
              "<a href='{{ route('admin.segmentos.edit', $segmento) }}'><u>{{ $segmento->segmento}}</u></a>",
              {{ $segmento->puntuacion }}
            ],
          @endforeach
          ]
        },
         @endforeach
      ]
    }
  });
</script> --}}
<script>
  Highcharts.chart('container', {
  chart: {
    type: 'column'
  },
  title: {
    text: ''
  },
  subtitle: {
    //text: 'Click the columns to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
    text: 'Click en las columnas para ver la calificacion por areas.'
  },
  xAxis: {
    type: 'category'
  },
  yAxis: {
    title: {
      text: 'Calificaciones'
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

  series: [
    {
      name: "SUCURSALES",
      colorByPoint: true,
      data: [
        {
          name: "Centro",
          y: 99.74,
          drilldown: "Centro"
        },
        {
          name: "Insurgentes",
          y: 81.57,
          drilldown: "Insurgentes"
        },
        {
          name: "Condesa",
          y: 78.23,
          drilldown: "Condesa"
        },
        {
          name: "Lomas de chapultepec",
          y: 67.58,
          drilldown: "Lomas de chapultepec"
        },
        {
          name: "Palmas",
          y: 56.02,
          drilldown: "Palmas"
        },
        {
          name: "Polanco",
          y: 45.92,
          drilldown: "Polanco"
        },
        {
          name: "Reforma",
          y: 42.62,
          drilldown: "Reforma"
        },
        {
          name: "Roma",
          y: 38.62,
          drilldown: "Roma"
        },
        {
          name: "Santa Fe - Arcos",
          y: 35.62,
          drilldown: "Santa Fe - Arcos"
        },
        {
          name: "Coyoacán",
          y: 10.90,
          drilldown: "Coyoacán"
        },
        {
          name: "Pedregal",
          y: 8.60,
          drilldown: "Pedregal"
        }
      ]
    }
  ],
  drilldown: {
    series: [
      {
        name: "Centro",
        id: "Centro",
        data: [
          [
            "<a href='{{ route('pages.planes') }}'>INSTALACIONES Y ÁREAZA</a>",
            90.1
          ],
          [
            "<a href='{{ route('pages.planes') }}'>EQUIPO Y UTENSILIOZA</a>",
            1.3
          ],
          [
            " <a href='{{ route('pages.planes') }}'> SERVICIOS</a> ",
            53.02
          ],
          [
            "<a href='{{ route('pages.planes') }}'>ALMACENAMIENTZA</a>",
            1.4
          ],
          [
            "<a href='{{ route('pages.planes') }}'>CONTROLES DE OPERACIÓZA</a>",
            0.88
          ],
          [
            "<a href='{{ route('pages.planes') }}'>MATERIAS PRIMAZA</a>",
            0.1
          ],
          [
            "<a href='{{ route('pages.planes') }}'>ENVASEZA</a>",
            53.02
          ],
      [
            "<a href='{{ route('pages.planes') }}'>AGUA EN CONTACTO CON LOS ALIMENTOZA</a>",
            2.6
          ],
          [
            "<a href='{{ route('pages.planes') }}'>MANTENIMIENTO Y LIMPIEZA</a>",
            1.3
          ],
          [
            "<a href='{{ route('pages.planes') }}'>MANEJO DE RESIDUOZA</a>",
            4.3
          ],
          [
            "<a href='{{ route('pages.planes') }}'>SALUD E HIGUIENE DEL PERSONAZA</a>",
            4.3
          ],
          [
            "<a href='{{ route('pages.planes') }}'>TRANSPORTZA</a>",
            4.3
          ],
          [
            "<a href='{{ route('pages.planes') }}'>DOCUMENTOS Y CAPACITACIÓZA</a>",
            4.3
          ]
        ]
      },
      {
        name: "Durango",
        id: "Durango",
        data: [
          [
            "INSTALACIONES Y ÁREAS",
            1.02
          ],
          [
            "EQUIPO Y UTENSILIOS",
            7.36
          ],
          [
            "SERVICIOS",
            0.35
          ],
          [
            "ALMACENAMIENTO",
            0.11
          ],
          [
            "CONTROLES DE OPERACIÓN",
            0.1
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
      {
        name: "Insurgentes",
        id: "Insurgentes",
        data: [
          [
            "INSTALACIONES Y ÁREAS",
            6.2
          ],
          [
            "EQUIPO Y UTENSILIOS",
            0.29
          ],
          [
            "SERVICIOS",
            0.27
          ],
          [
            "ALMACENAMIENTO",
            0.47
          ],
          [
            "CONTROLES DE OPERACIÓN",
            0.47
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
      {
        name: "Condesa",
        id: "Condesa",
        data: [
          [
            "INSTALACIONES Y ÁREAS",
            3.39
          ],
          [
            "EQUIPO Y UTENSILIOS",
            0.96
          ],
          [
            "SERVICIOS",
            0.36
          ],
          [
            "ALMACENAMIENTO",
            0.54
          ],
          [
            "CONTROLES DE OPERACIÓN",
            0.13
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
      {
        name: "Lomas de chapultepec",
        id: "Lomas de chapultepec",
        data: [
          [
            "INSTALACIONES Y ÁREAS",
            2.6
          ],
          [
            "EQUIPO Y UTENSILIOS",
            0.92
          ],
          [
            "SERVICIOS",
            0.4
          ],
          [
            "ALMACENAMIENTO",
            0.1
          ],
          [
            "CONTROLES DE OPERACIÓN",
            0.1
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
      {
        name: "Palmas",
        id: "Palmas",
        data: [
          [
            "INSTALACIONES Y ÁREAS",
            0.96
          ],
          [
            "EQUIPO Y UTENSILIOS",
            0.82
          ],
          [
            "SERVICIOS",
            0.14
          ],
          [
            "ALMACENAMIENTO",
            0.1
          ],
          [
            "CONTROLES DE OPERACIÓN",
            0.1
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
      {
        name: "Polanco",
        id: "Polanco",
        data: [
          [
            "INSTALACIONES Y ÁREAS",
            2.6
          ],
          [
            "EQUIPO Y UTENSILIOS",
            0.92
          ],
          [
            "SERVICIOS",
            0.4
          ],
          [
            "ALMACENAMIENTO",
            0.1
          ],
          [
            "CONTROLES DE OPERACIÓN",
            0.1
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
      {
        name: "Reforma",
        id: "Reforma",
        data: [
          [
            "INSTALACIONES Y ÁREAS",
            2.6
          ],
          [
            "EQUIPO Y UTENSILIOS",
            0.92
          ],
          [
            "SERVICIOS",
            0.4
          ],
          [
            "ALMACENAMIENTO",
            0.1
          ],
          [
            "CONTROLES DE OPERACIÓN",
            0.1
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
      },{
        name: "Roma",
        id: "Roma",
        data: [
          [
            "INSTALACIONES Y ÁREAS",
            2.6
          ],
          [
            "EQUIPO Y UTENSILIOS",
            0.92
          ],
          [
            "SERVICIOS",
            0.4
          ],
          [
            "ALMACENAMIENTO",
            0.1
          ],
          [
            "CONTROLES DE OPERACIÓN",
            0.1
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
      },{
        name: "Santa Fe - Arcos",
        id: "Santa Fe - Arcos",
        data: [
          [
            "INSTALACIONES Y ÁREAS",
            2.6
          ],
          [
            "EQUIPO Y UTENSILIOS",
            0.92
          ],
          [
            "SERVICIOS",
            0.4
          ],
          [
            "ALMACENAMIENTO",
            0.1
          ],
          [
            "CONTROLES DE OPERACIÓN",
            0.1
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
      {
        name: "Coyoacan",
        id: "Coyoacan",
        data: [
          [
            "INSTALACIONES Y ÁREAS",
            2.6
          ],
          [
            "EQUIPO Y UTENSILIOS",
            0.92
          ],
          [
            "SERVICIOS",
            0.4
          ],
          [
            "ALMACENAMIENTO",
            0.1
          ],
          [
            "CONTROLES DE OPERACIÓN",
            0.1
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
      {
        name: "Pedregal",
        id: "Pedregal",
        data: [
          [
            "INSTALACIONES Y ÁREAS",
            2.6
          ],
          [
            "EQUIPO Y UTENSILIOS",
            0.92
          ],
          [
            "SERVICIOS",
            0.4
          ],
          [
            "ALMACENAMIENTO",
            0.1
          ],
          [
            "CONTROLES DE OPERACIÓN",
            0.1
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
      }
    ]
  }
});
</script>

<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
        {
          label               : 'Electronics',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        },
      ]
    }

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