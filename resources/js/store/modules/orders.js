import axios from 'axios';

const state = {
    requests: [],
    orders: [],
    nrPlacedOrders: 0,
    nrRequests: 0,
    nrReadyForPickup: 0
};

const mutations = {
    SET_REQUESTS(state, requests) {
        state.requests = requests;
    },
    SET_ORDERS(state, orders) {
        state.orders = orders;
    }

};

const actions = {
    fetchRequests({commit}) {
        axios.get('/api/itemrequests').then(result => {
            commit('SET_REQUESTS', result.data);
        }).catch(error => {
            console.log(error);
        });
    },
    fetchOrders({commit}) {
        axios.get('api/orders').then(result => {
            commit('SET_ORDERS', result.data)
        }).catch(error => {
            console.log(error);
        });
    }
};

const getters = {
    getRequests: state => state.requests,
    getOrders: state => state.orders,
    getNrPlacedOrders: state => state.nrPlacedOrders,
    getNrRequests: state => state.nrRequests,
    getNrReadyforPickup: state => state.nrReadyForPickup
};

export default {
    state,
    mutations,
    actions,
    getters
}