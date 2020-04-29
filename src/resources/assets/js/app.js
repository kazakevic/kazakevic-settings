import Vue from 'vue'
import VueRouter from 'vue-router';
import { routes } from './routes';
import axios from 'axios'
import laravelPagination from 'laravel-vue-pagination';

window.axios = axios;

Vue.use(VueRouter);
Vue.component('pagination', laravelPagination);

const router = new VueRouter({
    routes,
});

const app = new Vue({
    el: '#app',
    router
});

