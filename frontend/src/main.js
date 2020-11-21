import Vue from 'vue'
import App from './App.vue'
import router from '@/router'
import store from '@/store'
import axios from 'axios'
import './assets/tailwind.css'
axios.defaults.withCredentials = true
axios.defaults.baseURL = 'http://localhost:8000'
Vue.config.productionTip = false

new Vue({
    router,
    store,
    render: h => h(App),
}).$mount('#app')
