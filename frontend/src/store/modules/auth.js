import axios from 'axios';
import router from '@/router'
/* STATE */
const state = {
    isLoggedIn: false,
    user: null
};

/* ACTIONS */
const actions = {
    async loadUser({ commit }) {
        try {
            const user = (await axios.get('/api/user')).data;
            commit('setUser', user.data);
            commit('setLoggedIn', true);
        } catch (error) {
            commit('setUser', null);
            commit('setLoggedIn', false);
            console.log(error)
        }
    },
    async logOut({ commit }) {
        try {
            await axios.post('/logout');
            commit('setUser', {})
            commit('setLoggedIn', false)
            router.go({ name: 'Home' })
        } catch (e) {
            console.log(e)
        }
    },
    async login({ dispatch }, credentials) {
        try {
            await axios.get('/sanctum/csrf-cookie');
            await axios.post('/login', {
                email: credentials.email,
                password: credentials.password
            });
            await dispatch('loadUser');
        } catch (error) {
            console.log(error)
        }
    }
};

/* MUTATIONS */
const mutations = {
    setUser(state, payload) {
        state.user = payload;
    },

    setLoggedIn(state, payload) {
        state.isLoggedIn = payload;
    }
};

/* GETTERS */
const getters = {
    getLoggedIn: state => state.isLoggedIn && state.user,
    getUser: state => state.user
};
export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}