require("./bootstrap");

window.Vue = require("vue");

import router from "./routes";

import Permissions from "./mixins/Permissions";

import Datepicker from 'vuejs-datepicker';

import Vue from 'vue'
import { Datetime } from 'vue-datetime'
// You need a specific loader for CSS files
import 'vue-datetime/dist/vue-datetime.css'


Vue.use(Datetime)
Vue.use(Datepicker);
Vue.mixin(Permissions);

Vue.component('chart-cuestionario', require('./components/PieChart.vue').default);
Vue.component('datetime', Datetime);

const app = new Vue({
    el: "#app",
    router
});
