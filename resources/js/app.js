'use strict';

import 'bootstrap'
import { createApp } from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from "@/views/App.vue";
import Login from "@/views/Login.vue";
import Home from "@/views/Home.vue";

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        }
    ]
});

createApp(App).use(router).mount('#app')
