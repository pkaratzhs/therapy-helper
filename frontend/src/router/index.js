import Vue from "vue";
import VueRouter from "vue-router";
import store from '@/store'
Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        name: "HomePage",
        component: () => import(/* webpackChunkName: "home" */ "../views/HomePage.vue"),
        meta: { requiresAuth: true }
    },
    {
        path: "/login",
        name: "Login",
        component: () => import(/* webpackChunkName: "home" */ "../views/auth/Login.vue"),
        meta: { hideAuth: true }
    },
    {
        path: "/register",
        name: "Register",
        component: () => import(/* webpackChunkName: "home" */ "../views/auth/Register.vue"),
        meta: { hideAuth: true }
    }

];

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes,
});
//basic redirection if not logged in
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if(!store.getters['auth/getLoggedIn']) next({name:'Login'})
        else next()
    }
    else if(to.matched.some(record => record.meta.hideAuth)){
        if(store.getters['auth/getLoggedIn']) next({name:'HomePage'})
        else next()
    } else next()
})

export default router;
