// import "bootstrap/dist/css/bootstrap.css"
import {
    createApp
} from 'vue'
import App from './App.vue'
import router from './router'
import './core/axios'

import axios from 'axios'
import VueAxios from 'vue-axios'

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import VSwitch from 'v-switch-case'
// import "./plugins/chart.js"

const app = createApp(App)

app.use(router)
app.mount('#app');
app.use(VueSweetalert2);
app.use(VueAxios, axios);
app.use(VSwitch);

// import "bootstrap/dist/js/bootstrap.js"