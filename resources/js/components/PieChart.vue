<template>
    <div class="container">
        <div class="form-group row">
            <div class="col-md-12">
                <div class="input-group ">
                    <select v-model="z" class="form-control col-md-6" id="">
                        <option value="0" selected>Selecciona Una Zona</option>
                        <option v-for="zona in zonas" :value="zona.zona" v-text="zona.zona"></option>
                    </select>
                    <datetime v-model="anio" format="yyyy" type="month" class="theme-orange" input-class="form-control" :value="`2020`"></datetime>
                    <datetime v-model="mes" format="MM" type="year" class="theme-orange" input-class="form-control" :value="`06`"></datetime>
                    <button type="submit" @click="listarZonas(z,anio,mes)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                </div>
            </div>
        </div>
        <h1>Vue laravel Chartjs</h1>
    <canvas ref="chart"></canvas>

    </div>
</template>
<script>
    export default{
        data(){
            return{
            zonas: [],
            mes: '',
            anio: '',
            region: '',
            z: '0'
            }
        },
        methods : {
          listarZonas(z,anio,mes){
              let me = this;
              var url = '/zonas?zona=' + z + '&anio=' + anio + '&criterio=' + mes;
              axios.get(url).then(res =>{
                  const respuesta = res.data;
                  me.zonas = respuesta.zonas;
                  var chart = this.$refs.chart;
                  var ctx = chart.getContext("2d");
                  var myChart = new Chart(ctx, {
                      type: 'pie',
                      data: {
                          labels: ['1'],
                          datasets: [{
                              backgroundColor: ["#41B883", "#E46651", "#00D8FF", "#D30AF2", "#FF380E"],
                              label: '# of Votes',
                              data: res.data.data,
                              borderWidth: 2
                          }]
                      },
                      options: {
                          scales: {
                              yAxes: [{
                                  ticks: {
                                      beginAtZero: true
                                  }
                              }]
                          }
                      }
                  });
              })
              .catch(err => {
                  console.log(err);
              });
          },
          // graficaCuestionario(){
          //     let url = '/chart/cuestionario/';
          //     axios.get(url).then((response) => {
          //
          //     }).catch(error => {
          //         console.log(error)
          //         this.errored = true
          //     });
          //
          // }
        },
        mounted(){
            this.listarZonas();
            // this.graficaCuestionario();

        }
    }
</script>
<style>
    .theme-orange .vdatetime-popup__header,
    .theme-orange .vdatetime-calendar__month__day--selected > span > span,
    .theme-orange .vdatetime-calendar__month__day--selected:hover > span > span {
        background: #FF9800;
    }

    .theme-orange .vdatetime-year-picker__item--selected,
    .theme-orange .vdatetime-time-picker__item--selected,
    .theme-orange .vdatetime-popup__actions__button {
        color: #ff9800;
    }
</style>
