import Vue from 'vue'
import VueRouter from 'vue-router';
import { routes } from './routes';
import axios from 'axios'

window.axios = axios;

Vue.use(VueRouter);

const router = new VueRouter({
    routes,
});

const app = new Vue({
    el: '#app',
    router
});

