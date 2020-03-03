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
							<h2 class="text-center">{{ $marca->name }}</h2>
                  <p class="text-center">Calificación de auditoria por sucursal <br>
                  <a class="text-center" href="{{ route('admin.auditorias.index') }}">Ver Planes de Acción</a></p>
						</div>
                  <div class="col-md-3">
                        <label for="graphic">Filtro por Fecha</label>
                        <form action="{{ route('admin.marcas.showcedula',$marca) }}" method="GET" class="form-inline">
                        <input type="hidden" name='cedula' value="{{ $cedula }}">
                        <input name="graphics" type="text" class="form-control pull-right" id="datepicker" placeholder="Elige un mes y año" autocomplete="off" value="{{ request('graphics') }}">
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
      <script src="https://code.highcharts.com/modules/exporting.js"></script>
      <script src="https://code.highcharts.com/modules/export-data.js"></script>
      <script src="https://code.highcharts.com/modules/accessibility.js"></script>  
      <script src="{{ asset('adminLTE/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script>
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
        @foreach ($sucursales as $sucursale)
          {
            name: "{{ $sucursale->name }}",
            y: 12, //calificacion en general
            drilldown: "{{ $sucursale->name }}"
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
          @foreach ($sucursales as $sucursale)
        {
          name: "{{ $sucursale->name }}",
          id: "{{ $sucursale->name }}",
          data: [
            @foreach ($sucursale->audres as $ares)
            [
              "<a href='{{ route('admin.segmentos.show', $ares->segmentos->IdSegmentoAuditoria) }}'>{{ $ares->segmentos->NombreSegmento }}</a>",
              {{ $ares->Promedio }}
            ],
            @endforeach
          ]
        },
        @endforeach
      ]
    }
  });
</script>
{{-- <script>
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
          name: "World Trade Center",
          y: 87.04,
          drilldown: "World Trade Center"
        },
        {
          name: "Taquearte del Valle",
          y: 83.33,
          drilldown: "Taquearte del Valle"
        },
        {
          name: "Taquearte Univerdidad",
          y: 75.93,
          drilldown: "Taquearte Univerdidad"
        },
        {
          name: "Operadora de Alimentos y Tacos SA de CV",
          y: 73.04,
          drilldown: "Operadora de Alimentos y Tacos SA de CV"
        },
        {
          name: "LAF Lerma",
          y: 70.33,
          drilldown: "LAF Lerma"
        },
        {
          name: "Operadora de Alimento Nueva York SA de CV",
          y: 68.93,
          drilldown: "Operadora de Alimento Nueva York SA de CV"
        },
        {
          name: "Grupo Gastronomico Glotoneri",
          y: 66.04,
          drilldown: "Grupo Gastronomico Glotoneri"
        },
        {
          name: "Operadora de Alimentos y Tacos SAPI de CV",
          y: 60.33,
          drilldown: "Operadora de Alimentos y Tacos SAPI de CV"
        },
        {
          name: "Grupo Gastronomico FAS SA de CV",
          y: 55.93,
          drilldown: "Grupo Gastronomico FAS SA de CV"
        },
        {
          name: "Central Gastronomica Hercules SAPI de CV",
          y: 50.04,
          drilldown: "Central Gastronomica Hercules SAPI de CV"
        },
        {
          name: "Administradora de Restaurantes CAF",
          y: 45.33,
          drilldown: "Administradora de Restaurantes CAF"
        },
        {
          name: "Operadora de Alimento Nueva YORK SA de CV (del Valle)",
          y: 40.93,
          drilldown: "Operadora de Alimento Nueva YORK SA de CV (del Valle)"
        },
      ]
    }
  ],
  drilldown: {
    series: [
      {
        name: "World Trade Center",
        id: "World Trade Center",
        data: [
          [
            "<a href='{{ route('pages.planes') }}'>INSTALACIONES Y ÁREAZA</a>",
            100
          ],
          [
            "<a href='{{ route('pages.planes') }}'>EQUIPO Y UTENSILIOZA</a>",
            100
          ],
          [
            " <a href='{{ route('pages.planes') }}'> SERVICIOS</a> ",
            57
          ],
          [
            "<a href='{{ route('pages.planes') }}'>ALMACENAMIENTZA</a>",
            75
          ],
          [
            "<a href='{{ route('pages.planes') }}'>CONTROLES DE OPERACIÓZA</a>",
            75
          ],
          [
            "<a href='{{ route('pages.planes') }}'>MATERIAS PRIMAS</a>",
            100
          ],
          [
            "<a href='{{ route('pages.planes') }}'>ENVASEZA</a>",
            100
          ],
          [
            "<a href='{{ route('pages.planes') }}'>AGUA EN CONTACTO CON LOS ALIMENTOZA</a>",
            100
          ],
          [
            "<a href='{{ route('pages.planes') }}'>MANTENIMIENTO Y LIMPIEZA</a>",
            87.66
          ],
          [
            "<a href='{{ route('pages.planes') }}'>MANEJO DE RESIDUOZA</a>",
            100
          ],
          [
            "<a href='{{ route('pages.planes') }}'>SALUD E HIGUIENE DEL PERSONAZA</a>",
            100
          ],
          [
            "<a href='{{ route('pages.planes') }}'>TRANSPORTZA</a>",
            100
          ],
          [
            "<a href='{{ route('pages.planes') }}'>DOCUMENTOS Y CAPACITACIÓZA</a>",
            86
          ]
        ]
      },
      {
        name: "Taquearte del Valle",
        id: "Taquearte del Valle",
        data: [
          [
            "<a href='{{ route('pages.planes') }}'>INSTALACIONES Y ÁREAZA</a>",
            100
          ],
          [
            "<a href='{{ route('pages.planes') }}'>EQUIPO Y UTENSILIOZA</a>",
            100
          ],
          [
            " <a href='{{ route('pages.planes') }}'> SERVICIOS</a> ",
            57
          ],
          [
            "<a href='{{ route('pages.planes') }}'>ALMACENAMIENTZA</a>",
            75
          ],
          [
            "<a href='{{ route('pages.planes') }}'>CONTROLES DE OPERACIÓZA</a>",
            75
          ],
          [
            "<a href='{{ route('pages.planes') }}'>MATERIAS PRIMAS</a>",
            100
          ],
          [
            "<a href='{{ route('pages.planes') }}'>ENVASEZA</a>",
            100
          ],
          [
            "<a href='{{ route('pages.planes') }}'>AGUA EN CONTACTO CON LOS ALIMENTOZA</a>",
            100
          ],
          [
            "<a href='{{ route('pages.planes') }}'>MANTENIMIENTO Y LIMPIEZA</a>",
            87.66
          ],
          [
            "<a href='{{ route('pages.planes') }}'>MANEJO DE RESIDUOZA</a>",
            100
          ],
          [
            "<a href='{{ route('pages.planes') }}'>SALUD E HIGUIENE DEL PERSONAZA</a>",
            100
          ],
          [
            "<a href='{{ route('pages.planes') }}'>TRANSPORTZA</a>",
            100
          ],
          [
            "<a href='{{ route('pages.planes') }}'>DOCUMENTOS Y CAPACITACIÓZA</a>",
            86
          ]
        ]
      },
      {
        name: "Taquearte Univerdidad",
        id: "Taquearte Univerdidad",
        data: [
          [
            "INSTALACIONES Y ÁREAS",
            0
          ],
          [
            "EQUIPO Y UTENSILIOS",
            66.66
          ],
          [
            "SERVICIOS",
            57.1
          ],
          [
            "ALMACENAMIENTO",
            75
          ],
          [
            "CONTROLES DE OPERACIÓN",
            78
          ],
          [
            "MATERIAS PRIMAS",
            100
          ],
          [
            "ENVASES",
            100
          ],
          [
            "AGUA EN CONTACTO CON LOS ALIMENTOS",
            100
          ],
          [
            "MANTENIMIENTO Y LIMPIEZA",
           75
          ],
          [
            "MANEJO DE RESIDUOS",
            100
          ],
          [
            "SALUD E HIGUIENE DEL PERSONAL",
            100
          ],
          [
            "TRANSPORTE",
            100
          ],
          [
            "DOCUMENTOS Y CAPACITACIÓN",
            76
          ]
        ]
      }
    ]
  }
});
</script> --}}
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