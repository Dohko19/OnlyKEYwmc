@extends('layouts.admin')
@section('content')
@section('header')
<ol class="breadcrumb float-sm-right">
  <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">WMC</a></li>
  <li class="breadcrumb-item active"><a href="{{ route('home.cedula', $marca) }}">Cedulas</a></li>
  <li class="breadcrumb-item active">Detalle de Cedula {{ $cedula }}</li>
</ol>
@endsection
@section('title', 'WMC | Mis Sucursales')
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
                  {{-- <a class="text-center" href="{{ route('admin.auditorias.index') }}">Ver Planes de Acción</a></p> --}}
						</div>
                  <div class="col-md-3">
                        <label for="graphic">Filtro por Fecha</label>
                        <form action="{{ route('admin.marcas.cedula',$marca) }}" method="GET" class="form-inline">
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
      <script src="{{ asset('highcharts/highcharts.js') }} "></script>
      <script src="{{ asset('highcharts/data.js') }} "></script>
      <script src="{{ asset('highcharts/drilldown.js') }} "></script>
      <script src="{{ asset('highcharts/exporting.js') }} "></script>
      <script src="{{ asset('highcharts/export-data.js') }} "></script>
      <script src="{{ asset('highcharts/accessibility.js') }} "></script>
      <script src="{{ asset('adminLTE/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script>
  Highcharts.chart('container', {
  chart: {
    type: 'column',
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
          @foreach ( $avg->sucursals->sortBy('average') as $average )
            {
              name: "{{ $average->name }}",
                y: {{ $average->average ?? 0}},  //calificacion en general
              drilldown: "{{ $average->name }}"
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
          @foreach ($avg->sucursals as $average)
        {
          name: "{{ $average->name }}",
          id: "{{ $average->name }}",
          data: [
          @forelse ($average->audres as $s)
                [
                "<a href='{{ route('admin.segmentos.show',['sucursal' => $average->name,'segmento' => $s->segmentos->IdSegmentoAuditoria, 'FechaRegistro' => request('graphics') ,'sucursal' => $average->name] ) }}'>{{ $s->segmentos->NombreSegmento }}</a>",
                {{ $s->Promedio ?? 0 }}
                ],
                @empty
                [
                "SIN DATOS",
                0
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

</script>
@endpush
