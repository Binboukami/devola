import Vue from "vue";
import App from "./App.vue";
import Vuesax from "vuesax";
import Axios from "axios";
import VueAxios from "vue-axios";
import store from "./store";

import "vuesax/dist/vuesax.css"; //Vuesax styles

Vue.use(Vuesax, {});
Vue.use(
  VueAxios,
  Axios.create({
    baseURL: "http://localhost:8000/api/",
    timeout: 3000,
  })
);

Vue.config.productionTip = false;

new Vue({
  store,
  render: (h) => h(App),
}).$mount("#app");
