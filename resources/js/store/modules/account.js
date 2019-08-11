import axios from 'axios';

const token = localStorage.getItem('token');
let user = false;

if (token) {
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
}

const state = {
    user:  {},
    token: token || '',
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
    login({commit}, user) {
        axios.post('/api/login', user)
            .then(result => {
                if (result.data.status === 200) {
                    const token = result.data.token;
                    commit('SET_USER', result.data.user);
                    commit('SET_TOKEN', token);
                    localStorage.setItem('token', token);
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
                    window.location = '/';
                }
            }).catch(error => {
            console.log(error);
        });
    },
    logout({commit}) {
        localStorage.removeItem('token');
        axios.post('/api/logout')
            .then(result => {
                commit('REMOVE_USER');
                commit('REMOVE_TOKEN');
                delete axios.defaults.headers.common['Authorization'];
            }).catch(error => {
            console.log(error);
        });
        window.location = '/login'
    },
    getUser({ commit }) {
        axios.get('/api/user').then(result => {
            if (result.data.status === 200) {
                commit('SET_USER', result.data.user);
            } else {
                delete axios.defaults.headers.common['Authorization'];
                localStorage.removeItem('token');
            }
        });
    }
};

const getters = {
    getUser: state => state.user,
    isUserLoaded: state => state.user === {},
    isLoggedIn: state => !!state.token,
    isAdmin: state => state.isAdmin,
};


export default {
    state,
    mutations,
    actions,
    getters,

}
