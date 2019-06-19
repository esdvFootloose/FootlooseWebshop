import axios from 'axios';

const state = {
    user: null,
    token: null,
    isAdmin: true
};

const mutations = {
    SET_USER(state, user) {
        state.user = user;
    },
    SET_TOKEN(state, token) {
        state.token = token;

    },
    REMOVE_USER(state) {
        state.user = null;
    },
    REMOVE_TOKEN(state) {
        state.token = null;
    }
};

const actions = {
    login({ commit }, user) {
        axios.post('/login', user)
            .then(result => {
                commit('SET_USER', result.data)
            }).catch(error => {
                console.log(error)
        });
    }
};

const getters = {
    getUser(state) {
        return state.user;
    },
    isLoggedIn(state) {
        return !!state.user;
    },
    isAdmin(state) {
        return state.isAdmin;
    }
};


export default {
    state,
    mutations,
    actions,
    getters,

}