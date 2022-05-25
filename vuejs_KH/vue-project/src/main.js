import {
    createApp
} from 'vue'
import App from './App.vue'
import router from './router'
import Vuex from 'vuex';

import axios from 'axios'
import VueAxios from 'vue-axios'
// import VueSocialauth from 'vue-social-auth'

import store from './store'

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';


const app = createApp(App)

app.use(router);
app.mount('#app');
app.use(VueAxios, axios);
app.use(Vuex);
app.use(store);
app.use(VueSweetalert2);

// app.use(VueSocialauth, {
//     providers: {
//         google: {
//             clientId: '35095267573-7hv1v49411rh6f0oi5i3s1c1kq561lsk.apps.googleusercontent.com',
//             client_secret: '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',
//             redirectUri: 'http://localhost:3001/api/login/google/callback'
//         }
//     }
// });
