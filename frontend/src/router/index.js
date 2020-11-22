import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        name: "HomePage",
        component: () => import(/* webpackChunkName: "home" */ "../views/HomePage.vue"),
    },
    {
        path: "/login",
        name: "Login",
        component: () => import(/* webpackChunkName: "home" */ "../views/auth/Login.vue"),
    },
];

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes,
});

export default router;
