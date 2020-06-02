require("./bootstrap");

window.Vue = require("vue");

import router from "./routes";

import Permissions from "./mixins/Permissions";

Vue.mixin(Permissions);


const app = new Vue({
    el: "#app",
    router
});
