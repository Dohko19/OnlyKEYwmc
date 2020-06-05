<template>
    <div class="container">
        <div class="form-group row">
            <div class="col-md-12">
                <div class="input-group ">
                    <select v-model="z" class="form-control col-md-6" id="">
                        <option v-for="zona in zonas" :value="zona.zona" v-text="zona.zona"></option>
                    </select>
                    <select v-model="region" class="form-control col-md-6">
                        <option v-for="r in regiones" :key="r.id" :value="r.region" v-text="r.region"></option>
                    </select>
                    <datetime v-model="anio" title="Mes"
                              format="yyyy"
                              type="month"
                              class="theme-orange"
                              input-class="form-control"
                              value="2020-01-01T00:06:00.000Z"
                    ></datetime>
                    <datetime v-model="mes"
                              title="Año"
                              format="MM"
                              type="year"
                              class="theme-orange"
                              input-class="form-control"
                              value="2020-06-05T00:06:00.000Z"></datetime>
                    <button type="submit" @click="graficaCuestionario(z,anio,mes)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                </div>
            </div>
        </div>
        <h1>Resultados</h1>
        <div class="chart-container" style="position: relative; height:40vh; width:80vw">
            <canvas ref="chart" id="chart"></canvas>
        </div>
    </div>
</template>
<script>
    export default{
        data(){
            return{
                zonas: [],
                mes: '',
                anio: '',
                regiones: [],
                region: 'CENTRO',
                z: 'ZMN',
                charQuestion: null,
                varQuestion: null,
                questions: [],
                varTotalQuestion: [],
                varNumQuestion:[]

            }
        },
        methods : {
            listarZonas(){
              let me = this;
              var url = '/zonas';
              axios.get(url).then(res =>{
                  const r = res.data;
                  me.zonas = r;
              })
              .catch(err => {
                  console.log(err);
              });
            },
            listarRegiones(){
              let me = this;
              axios.get('/regiones').then(res =>{
                  let respuesta = res.data;
                  this.regiones = respuesta;
              })
              .catch(err => {
                  console.log(err);
              })
            },
            graficaCuestionario(z,anio,mes){
              let me = this;
              let url = '/chart/cuestionario?zona=' + z + '&anio=' + anio + '&mes=' + mes;
              axios.get(url).then(res => {
                let answer = res.data;
                me.questions = answer;
                //Cargamos los datos del cahrt
                  me.loadQuestions();
              }).catch(error => {
                  console.log(error)
              });
            },
            loadQuestions(){
                let me = this;
                me.varNumQuestion = [];
                me.varTotalQuestion = [];
                me.questions.questionbad.map(function(x){
                    me.varNumQuestion.push(x.orden);
                    me.varTotalQuestion.push(x.fails);
                });
                me.varQuestion = document.getElementById('chart').getContext('2d');
                me.charQuestion = new Chart(me.varQuestion, {
                    type: 'pie',
                    data: {
                        labels: me.varNumQuestion,
                        datasets: [{
                            label: 'Preguntas',
                            data: me.varTotalQuestion,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)'
                            ],
                            borderColor: [
                                'rgb(255,99,132)'
                            ],
                            borderWidth: 1
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

            }
        },
        mounted(){
            this.listarZonas();
            this.listarRegiones();
            this.graficaCuestionario(this.z,this.anio,this.mes);
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
