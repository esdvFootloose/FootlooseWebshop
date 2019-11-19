import axios from 'axios';

const state = {
    order: {},
    orders: [],
    requests: [],
};

const mutations = {
    SET_REQUESTS(state, requests) {
        state.requests = requests;
    },
    SET_ORDER(state, order) {
        state.order = order;
    },
    SET_ORDERS(state, orders) {
        state.orders = orders;
    }
};

const actions = {
    fetchRequests({commit}) {
        axios.get('/api/itemrequests').then(result => {
            commit('SET_REQUESTS', result.data.data);
        }).catch(error => {
            console.error(error);
        });
    },
    fetchOrder({commit}, id) {
        axios.get('/api/orders/' + id).then(result => {
            commit('SET_ORDER', result.data.data);
        }).catch(error => {
            console.error(error)
        });
    },
    fetchOrders({commit}) {
        axios.get('/api/orders').then(result => {
            commit('SET_ORDERS', result.data.data);
        }).catch(error => {
            console.error(error);
        });
    },
    fetchAllDashboard({dispatch}) {
        dispatch('fetchOrders');
        dispatch('fetchRequests');
    },
    removeItemRequest({commit, dispatch}, itemRequestId) {
        axios.delete('/api/itemrequests/' + itemRequestId).then(result => {
            dispatch('fetchRequests');
        }).catch(error => {
            console.error(error);
        })
    }
};

const getters = {
    getItemRequests: state => state.requests,
    getOrder: state =>state.order,
    getOrders: state => state.orders,
    getNrOrders: state => state.orders.length,
    getNrPlacedOrders: state => state.orders.filter(order => !order.is_picked_up).length,
    getNrRequests: state => state.requests.length,
    getNrReadyforPickup: state => state.orders.filter(order => order.is_paid && !order.is_picked_up).length,
};

export default {
    state,
    mutations,
    actions,
    getters
}
