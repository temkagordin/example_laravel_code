import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';

import App from './components/App.vue';
import Home from './components/Home.vue';
import Login from './components/Login.vue';
import SignUp from './components/SignUp.vue';
import Dashboard from './components/Dashboard.vue';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

axios.defaults.baseURL = 'http://test.loc:8000/api';

const router = new VueRouter({
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: 'login',
            name: 'login',
            component: Login,
            meta: {
                auth: false
            }
        }, {
            path: '/signup',
            name: 'signup',
            component: SignUp,
            meta: {
                auth: false
            }
        }, {
            path: '/dashboard',
            name: 'dashboard',
            components: Dashboard,
            meta:{
                auth:true
            }
        }
    ]
});
Vue.router = router;

Vue.use(require('@websanova/vue-auth'), {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
});

App.router = Vue.router;

new Vue(App).$mount('#app');