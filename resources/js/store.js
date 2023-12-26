import { createStore } from 'vuex';
import createPersistedState from 'vuex-persistedstate';

const state = {
    token: '',
};

const mutations = {
    setToken(state, newValue) {
        state.token = newValue;
    },

};

const getters = {
    getToken: state => state.token,
};

export default createStore({
    state,
    mutations,
    getters,
    plugins: [createPersistedState()],
});
