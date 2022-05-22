import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import Vuex from 'vuex';

import axios from 'axios'
import VueAxios from 'vue-axios'

import store from './store'

const app = createApp(App)

app.use(router);
app.mount('#app');
app.use(VueAxios, axios);
app.use(Vuex);
app.use(store);

