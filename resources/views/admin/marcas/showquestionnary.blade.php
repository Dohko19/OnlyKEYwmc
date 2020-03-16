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
						<div class="col-md-2">
							<img src="{{ url('marcas/'.$marca->photo) }}" alt="" width="150px" height="100px">
						</div>
						<div class="col-md-6 text-center">
              <div class="row">
                  <div class="col-md-4">
                        {{-- @foreach ($delegaciones->sucursals as $d)
                        {{ $d->delegacion_municipio }}
                        @endforeach --}}
                  </div>
                <div class="col-md-7">
    							<h3 class="text-center">
            			 {{ $marca->name }}
          				</h3>
                  <small class="text-justify"><b>Calificacion por Delegacion:</small>
                  {{ request('dm') }}</b>
                </div>
                <div class="col-md-2"></div>
              </div>
						</div>
			            <div class="col-md-4 col-sm-4">
			              <form action="{{ route('admin.marcas.show',$marca) }}" method="GET" class="form-inline">
                      <div class="form-group">
                        <input type="hidden" name="zone" value="{{ $zona }}">
                        <input type="hidden" name="zonaf" value="{{ $delegacion }}">
  			                <input size="5" name="graphics" type="text" class="form-control pull-right" id="datepicker" value="{{ old('graphics', request('graphics')) }}" placeholder="mes y año" autocomplete="off"><br>
                        <select class="form-control" name="dm" id="dm">
                          @foreach ($delegaciones->sucursals as $d)
                              <option {{ old('dm', request('dm')) == $d->delegacion_municipio ? 'selected' : ''}}  value="{{ $d->delegacion_municipio }}">{{ $d->delegacion_municipio }}</option>
                          @endforeach
                        </select>
                        {{-- {{ request('dm') }} --}}
                        {{-- <input name="dm" type="text" class="form-control" autocomplete="off" size="6" value="{{ old('dm') }}" placeholder="Delegación..."> --}}

			                <button type="submit" class="btn btn-default float-right">
			                    <i class="fas fa-search"></i>
			                </button>
                      </div>
			              </form>
			            </div>
					</div>
          <br>
        <div class="row">
          <div class="col-12">
            <!-- Custom Tabs -->
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Nivel de Riesgo  </h3>
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link active" href="#tab_2" data-toggle="tab">Riesgos Inminentes</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_1" data-toggle="tab">Criticos</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane " id="tab_1">
          					<div class="">
          						<div id="ri" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                      <div class="row">
                        <div class="col-md-11">
                        @foreach ($preguntasLeft as $pl)
                            <small>{{ $pl->IdPregunta }}.- {{ $pl->Pregunta }} </small> <br>
                        @endforeach
                        </div>
                        <div class="col-md-1"></div>
                      </div>
          					</div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane active" id="tab_2">
          					<div class="justify-content-start">
          						<div id="critico" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                      <div class="row">
                        <div class="col-md-11">
                        @foreach ($preguntasRigth as $pr)
                            <small>{{ $pr->IdPregunta }}.- {{ $pr->Pregunta }}</small> <br>
                        @endforeach
                      </div>
                      <div class="col-md-1"></div>
          					</div>
                  </div>
                  <!-- /.tab-pane -->

                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->

            <!-- ./card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- END CUSTOM TABS -->

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
      <script src="http://code.highcharts.com/modules/exporting.js"></script>
      {{-- Herramienta para exportar en CSV XLS excel
      <script src="https://code.highcharts.com/modules/export-data.js"></script> --}}
      <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
      <script src="{{ asset('adminLTE/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
      <script src="{{ asset('adminLTE/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
  Highcharts.setOptions({
  lang: {
    resetZoom: 'Alejar',
    viewFullscreen: 'Ver en pantalla completa',
    downloadJPEG: 'Descargar en JPEG',
    downloadPNG: 'Descargar en PNG',
    downloadSVG: 'Descargar en SVG imagen de vectores',
    downloadPDF: 'Descargar en documento PDF',
  }
  });

  Highcharts.chart('critico', {
    chart: {
        zoomType: 'x',
        resetZoomButton: {
            position: {
                x: -120,
                y: -40
            }
          },
         panning: true,
         type: 'column',
         animation: {
         duration: 1000
        },
        events: {
              load: function () {
                  var label = this.renderer.label("")
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
              },
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
      text: 'Click en las columnas para ver la calificacion por sucursal Riesgos Inminentes.'
    },
    accessibility: {
          announceNewData: {
              enabled: true
          }
      },
    xAxis: {
       title: {
        text: 'Preguntas',
        title: 'Sucursales'
      },
      type: 'category'
    },
    yAxis: {
      min: 0,
      title: {
        text: 'Calificaciones',
        title: 'Sucursales',
         align: 'high'
      },
    },
    scrollbar: {
        enabled: true,
        liveRedraw: false
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
        name: "Sucursales",
        colorByPoint: true,
        data: [
            @foreach ( $sucursales->sucursals as $ris)
                  {
                    name: "{{ $ris->name }}",
                    y: {{ $ris->RI ?? 0 }}, //proemdio
                    drilldown: "{{ $ris->name }}"
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
          @foreach($sucursales->sucursals as $sucursal)
        {
          name: "{{ $sucursal->name }}",
          id: "{{ $sucursal->name }}",
          data: [
              @forelse ( $sucursal->questionaries->sortBy('IdPregunta')  as $q)
                @if($q->riesgo == 'RI')
                  @if ($q->Value == '1')
                      [
                        "{{ $q->IdPregunta }}",
                          100,
                      ],
                    @elseif($q->Value == NULL)
                      [
                        "{{ $q->IdPregunta }}",
                          0.0,
                      ],
                    @else
                      [
                        "{{ $q->IdPregunta }}",
                          0.0,
                      ],
                  @endif
                @endif
                @empty
                      [
                        "Sin datos",
                          0.0,
                      ],
              @endforelse
          ]
        },
         @endforeach
      ]
    }
  });
</script>
<script>
  Highcharts.chart('ri', {
    chart: {
         zoomType: 'x',
         resetZoomButton: {
            position: {
                // align: 'right', // by default
                // verticalAlign: 'top', // by default
                x: -120,
                y: -40
            }
          },
         panning: true,
         type: 'column',
         animation: {
         duration: 1000
        },
         animation: {
         duration: 1000
        },
      events: {
              load: function () {
                  var label = this.renderer.label("")
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
      text: 'Click en las columnas para ver la calificacion por sucursal Criticos.'
    },
    accessibility: {
          announceNewData: {
              enabled: true
          }
      },
    xAxis: {
      title: {
        text: 'Preguntas',
        title: 'Sucursales'
      },
      type: 'category',
    },
    yAxis: {
      title: {
        text: 'Calificaciones',
        title: 'Sucursales'
      },
    },
    scrollbar: {
      enabled: true,
      liveRedraw: false
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
        name: "Sucursales",
        colorByPoint: true,
        data: [
            @foreach ( $sucursales->sucursals as $ris)
                  {
                        name: "{{ $ris->name }}",
                        y: {{ $ris->C ?? 0 }}, //proemdio
                        drilldown: "{{ $ris->name }}"
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
          @foreach ($sucursales->sucursals as $sucursal)
        {
          name: "{{ $sucursal->name }}",
          id: "{{ $sucursal->name }}",
          data: [
              @forelse ( $sucursal->questionaries->sortBy('IdPregunta')  as $q)
                @if($q->riesgo == 'C')
                @if ($q->Value == '1')
                  [
                    "{{ $q->IdPregunta }}",
                      100,
                  ],
                @else
                  [
                    "{{ $q->IdPregunta }}",
                      0.0,
                  ],
                @endif
                @endif
                @empty
                  [
                    "Sin datos",
                      0.0,
                  ],
              @endforelse
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
 $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
@endpush
