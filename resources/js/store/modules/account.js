import axios from "axios";

const token = localStorage.getItem("token");
let user = false;

if (token) {
    axios.defaults.headers.common["Authorization"] = "Bearer " + token;
}

const state = {
    user: {},
    token: token || "",
    isAdmin: false,
    error: ""
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
    },
    SET_ADMIN(state, isAdmin) {
        state.isAdmin = isAdmin;
    },
    SET_ERROR(state, error) {
        state.error = error;
    }
};

const actions = {
    login({ dispatch, commit }, user) {
        axios
            .post("/api/login", user)
            .then(result => {
                if (result.data.status === 200) {
                    const token = result.data.token;
                    commit("SET_USER", result.data.user);
                    commit("SET_TOKEN", token);
                    commit("SET_ERROR", "");
                    localStorage.setItem("token", token);
                    axios.defaults.headers.common["Authorization"] =
                        "Bearer " + token;
                    dispatch("fetchUserRights");
                    window.location = "/";
                } else {
                    console.log('error 1', result.data);
                    console.log('error 2', result.data.error);
                    commit("SET_ERROR", result.data.error);
                }
            })
            .catch(error => {
                console.log("error 3", error);
                commit("SET_ERROR", error.data.error);
            });
    },
    logout({ commit }) {
        localStorage.removeItem("token");
        axios
            .post("/api/logout")
            .then(result => {
                commit("REMOVE_USER");
                commit("REMOVE_TOKEN");
                commit("SET_ADMIN", false);
                delete axios.defaults.headers.common["Authorization"];
            })
            .catch(error => {
                console.log(error);
            });
        window.location = "/login";
    },
    getUser({ commit }) {
        axios.get("/api/user").then(result => {
            if (result.data.status === 200) {
                commit("SET_USER", result.data.user);
            } else {
                delete axios.defaults.headers.common["Authorization"];
                localStorage.removeItem("token");
            }
        });
    },
    fetchUserRights({ commit }) {
        axios.get("/api/rights").then(result => {
            if (result.data.data) {
                commit("SET_ADMIN", true);
            } else {
                commit("SET_ADMIN", false);
            }
        });
    }
};

const getters = {
    getUser: state => state.user,
    isUserLoaded: state => state.user === {},
    isLoggedIn: state => !!state.token,
    isAdmin: state => state.isAdmin,
    getError: state => state.error
};

export default {
    state,
    mutations,
    actions,
    getters
};
