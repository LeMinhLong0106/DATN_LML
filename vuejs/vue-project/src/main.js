// import "bootstrap/dist/css/bootstrap.css"
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

import axios from 'axios'
import VueAxios from 'vue-axios'
import VueSocialauth from 'vue-social-auth'

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

const app = createApp(App)



app.use(router)
app.mount('#app');
app.use(VueSweetalert2);
app.use(VueAxios, axios);
app.use(VueSocialauth, {
    providers: {
        google: {
            clientId: '35095267573-hfoj06ltl06sku36bq04ljeavbh92jje.apps.googleusercontent.com',
            client_secret: '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',
            redirectUri: 'http://localhost:3000/auth/google/callback'
        }
    }
});

// import "bootstrap/dist/js/bootstrap.js"