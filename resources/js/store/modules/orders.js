import axios from 'axios';

const state = {
    orders: [],
    requests: [],
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
            commit('SET_REQUESTS', result.data.data);
        }).catch(error => {
            console.log(error);
        });
    },
    fetchOrders({commit}) {
        axios.get('/api/orders').then(result => {
            commit('SET_ORDERS', result.data.data);
        }).catch(error => {
            console.log(error);
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
            console.log(error);
        })
    }
};

const getters = {
    getItemRequests: state => state.requests,
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
