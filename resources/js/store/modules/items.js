import axios from 'axios';


const cartCookie = localStorage.getItem('cart');

const state = {
    items: [],
    itemsDashboard: [],
    cart: cartCookie || [],
    nrItemsOutOfStock: 0,
};

const mutations = {
    SET_ITEMS(state, items) {
        state.items = items;
    },
    SET_ITEMS_DASHBOARD(state, items) {
        state.itemsDashboard = items;
    },
    ADD_TO_CART(state, item) {
        state.cart.push(item);
    },
    REMOVE_FROM_CART(state, item) {
        let indexItem = state.cart.indexOf(state.cart.filter(cartItem => cartItem.item === item)[0]);
        if (indexItem !== -1) state.cart.splice(indexItem, 1);
    },
    ADJUST_ITEM(state, item, amount) {
        let indexItem = state.cart.indexOf(state.cart.filter(cartItem => cartItem.item === item)[0]);
        state.cart[indexItem].amount = amount;
    },
    CLEAR_CART(state) {
        state.cart = [];
    }
};

const actions = {
    fetchItems({commit}) {
        axios.get('/api/items').then(result => {
            commit('SET_ITEMS', result.data.data);
        }).catch(error => {
            console.log(error);
        })
    },
    fetchItemsDashboard({commit}) {
        axios.get('/api/itemsDashboard').then(result => {
            commit('SET_ITEMS_DASHBOARD', result.data.data);
        }).catch(error => {
            console.log(error);
        })
    },
    addItemToCart({commit}, item, amount) {
        let cartItem = {
            item: item,
            amount: amount
        };
        commit('ADD_TO_CART', cartItem);
        localStorage.setItem('cart', state.cart);
    },
adjustCartItem({commit}, item, amount) {
    commit('ADJUST_ITEM', item, amount);
    localStorage.setItem('cart', state.cart);
},
removeItemFromCart({commit}, item) {
    commit('REMOVE_FROM_CART', item);
    localStorage.setItem('cart', state.cart);
},
clearCart({commit}) {
    commit('CLEAR_CART');
    localStorage.removeItem('cart');
}
};
const getters = {
    getItems: state => state.items,
    getItemsDashboard: state => state.itemsDashboard,
    getItem(state) {
        return slug => state.items.find(item => {
            return item.slug === slug;
        })
    },
    getCart: state => state.cart,
    getNrItemsOutOfStock: state => state.nrItemsOutOfStock
};

export default {
    state,
    mutations,
    actions,
    getters,
}
