//import Log from "./module/log";


import LumenCard from "./components/LumenCard";

require('./bootstrap');
//import Auth from '../js/module/auth';
//window.auth = new Auth();
//window.log = new Log();



import { createApp } from 'vue';
// import router from './module/router/router';
// import store from "./module/store";
// import Vue3Transitions from "vue3-transitions";
// import Style from "../assets/css/style.bundle.css";
import Animate from "animate.css";
//import Jss from "../assets/js/scripts.bundle.js";
//import JsWidgets from "../assets/js/widgets.bundle.js";

//import VueSweetalert2 from 'vue-sweetalert2';
// import 'sweetalert2/dist/sweetalert2.min.css';
// import Toaster from '@meforma/vue-toaster';
// import sweetalert from 'vue-sweetalert2';
// import index from "./module/router/index";
// import { plugin, defaultConfig } from '@formkit/vue';
// import { FormKitSchema } from '@formkit/vue'
import ActiveCard from "./components/ActiveCard";
import WaterCard from "./components/WaterCard";
import UserHeader from "./components/header/UserHeader";
import PlayerCard from "./components/PlayerCard";

const app = createApp({
    //router,
});
// app.use(store);
// app.use(router);
// app.use(sweetalert);
// app.use(Toaster,{
//     position: 'top-right',
//     max:5
// });
// app.use(Vue3Transitions);
// app.use(plugin,defaultConfig(),FormKitSchema);
 app.use(Animate);
// app.provide('Toaster', app.config.globalProperties.$toast)
//app.component('index',index)
app.component('water-card',WaterCard);
app.component('user-header',UserHeader);
app.component('active-card',ActiveCard);
app.component('lumen-card',LumenCard);
app.component('player-card',PlayerCard);
app.mount('#app');
