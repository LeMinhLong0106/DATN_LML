import {
    createApp
} from 'vue'
import App from './App.vue'
import router from './router'
import './axios'
// vuex 
import store from './store'
// vue-axios 
import axios from 'axios'
import VueAxios from 'vue-axios'
// sweetalert2
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

const app = createApp(App)

app.use(router)
app.use(store)
app.mount('#app');
app.use(VueSweetalert2);
app.use(VueAxios, axios);

