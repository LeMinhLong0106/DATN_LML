import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import Vuex from 'vuex';

import './axios'
import axios from 'axios'
import VueAxios from 'vue-axios'

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

const app = createApp(App)

app.use(router)
app.use(store)
app.use(VueAxios, axios);
app.use(Vuex);
app.use(VueSweetalert2);
app.mount('#app')