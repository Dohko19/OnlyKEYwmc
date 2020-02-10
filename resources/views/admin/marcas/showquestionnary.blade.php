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
              					<p class="text-center">Calificación por sucursal</p>
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
          @foreach ($sucursales as $sucursal)
              {{ $sucursal }}
          @endforeach
					<!--Graficas-->
        <div class="row">
          <div class="col-12">
            <!-- Custom Tabs -->
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Navegacion</h3>
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Riesgos Inminentes</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Criticos</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
					<div class="text-center">
						<div id="critico" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        				<small class="text-muted"></small>
					</div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
					<div class="text-center">
						<div id="critico" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        				<small class="text-muted"></small>
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
 	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/data.js"></script>
	<script src="https://code.highcharts.com/modules/drilldown.js"></script>
  <script src="http://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <script src="{{ asset('adminLTE/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script>
Highcharts.chart('critico', {
  chart: {
    type: 'column',
    events: {
            load: function () {
                var label = this.renderer.label("*Click en el nombre para ver detalladamente")
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
          y: {{ $average }}, //proemdio
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