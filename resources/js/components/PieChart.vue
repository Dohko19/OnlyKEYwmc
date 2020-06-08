<template>
    <div class="container">
        <div class="form-group row">
            <div class="col-md-12">
                <transition name="fade">
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
                        <button type="submit" @click="graficaCuestionario(z,anio,mes,region)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                    </div>
                </transition>
            </div>
        </div>
        <h1>Resultados</h1>
            <div class="row">
                <div class="col-md-12">
                    <canvas ref="chart" id="chartjs"></canvas>
                </div>
                <div>
                    <div class="col-md-12" v-for="question in questions.questionbad">
                            <p>{{ question.orden }} - {{ question.pregunta }}</p>
                            <span style="color: red;">Correspondientes a la Sucursal: {{ question.sucursal }}</span>
                        <br><br>
                        </div>
                    </div>
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
                varNumQuestion:[],
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
            graficaCuestionario(z,anio,mes, region){ //obtengo los datos para graficarlos
              let me = this;
              me.questions = [];
              let url = '/chart/cuestionario?zona=' + z + '&anio=' + anio + '&mes=' + mes + '&region=' + region;
              axios.get(url).then(res => {
                let answer = res.data;
                me.questions = answer;
                //Cargamos los datos del cahrt
                me.loadQuestions()
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
                me.varQuestion = document.getElementById('chartjs').getContext('2d');
                if(me.varNumQuestion.length && me.varTotalQuestion.length)
                {
                    me.charQuestion = new Chart(me.varQuestion, {
                        type: 'pie',
                        data: {
                            labels: me.varNumQuestion,
                            datasets: [{
                                label: 'Preguntas',
                                data: me.varTotalQuestion,
                                backgroundColor: [
                                    'rgba(255,99,132,0.97)',
                                    'rgba(99,255,224,0.98)',
                                    'rgb(75,221,12)',
                                    'rgb(214,141,17)',
                                    'rgb(255,0,0)',
                                    'rgb(88,11,196)',
                                    'rgb(0,255,216)',
                                ],
                                borderColor: [
                                    'rgb(255,99,132)',
                                    'rgb(46,110,93)',
                                    'rgb(44,117,35)',
                                    'rgb(141,107,40)',
                                    'rgba(207,23,23,0.84)',
                                    'rgba(50,25,143,0.58)',
                                    'rgb(1,143,255)',
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            // scales: {
                            //     yAxes: [{
                            //         ticks: {
                            //             beginAtZero: true
                            //         }
                            //     }]
                            // }
                        }
                    });
                }
                else
                {
                    me.varNumQuestion = [];
                    me.varTotalQuestion = [];
                    me.charQuestion = new Chart(me.varQuestion, {
                        type: 'pie',
                        data: {
                            labels: ['Sin Datos'],
                            datasets: [{
                                label: 'Preguntas',
                                data: [0],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            // scales: {
                            //     yAxes: [{
                            //         ticks: {
                            //             beginAtZero: true
                            //         }
                            //     }]
                            // }
                        }
                    });

                }
            }
        },
        mounted(){
            this.listarZonas();
            this.listarRegiones();
            this.graficaCuestionario(this.z,this.anio,this.mes);

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
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0
    }
</style>
