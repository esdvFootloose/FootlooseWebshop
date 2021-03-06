require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';

// Router
import 'es6-promise/auto';
import store from './store';

import App from './views/App';
import router from './router';


import axios from 'axios';

Vue.use(VueRouter);

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store
});