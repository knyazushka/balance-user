import { createRouter, createWebHistory } from "vue-router";

import Dashboard from "@/components/Dashboard.vue";
import Login from "@/components/Login.vue";
import Operations from "@/components/Operations.vue";

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Dashboard,
        meta: { public: false, }
    },
    {
        path: '/operations',
        name: 'Operations',
        component: Operations,
        meta: { public: false, }
    },
    {
        path: '/login',
        name: 'Login',
        component: Login,
        meta: { public: true, }
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const isAuthenticated = !!localStorage.getItem('token');

    if (!to.meta.public && !isAuthenticated) {
        next({ name: 'Login' });
    } else {
        next();
    }
});

export default router;
