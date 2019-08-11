import axios from 'axios';
import rootState from 'vuex'


const cartCookie = JSON.parse(localStorage.getItem('cart'));

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
        let indexItem = state.cart.indexOf((state.cart.filter(filterItem => filterItem.item_id === item.item_id && filterItem.size_id === item.size_id))[0]);
        if (indexItem !== -1) state.cart.splice(indexItem, 1);
    },
    ADJUST_ITEM(state, item) {
        let indexItem = state.cart.indexOf((state.cart.filter(filterItem => filterItem.item_id === item.item_id && filterItem.size_id === item.size_id))[0]);
        state.cart[indexItem].amount = item.amount;
    },
    CLEAR_CART(state) {
        state.cart = [];
    },
};

const actions = {
    fetchItems({commit}) {
        axios.get('/api/itemsDashboard').then(result => {
            commit('SET_ITEMS', result.data.data);
        }).catch(error => {
            console.log(error);
        })
    },
    fetchItemsDashboard({commit}) {
        axios.get('/api/items').then(result => {
            commit('SET_ITEMS_DASHBOARD', result.data.data);
        }).catch(error => {
            console.log(error);
        })
    },
    addItemToCart({commit}, item) {
        commit('ADD_TO_CART', item);
        setCookie();
    },
    adjustCartItem({commit}, item) {
        console.log('adjust item:', item);
        commit('ADJUST_ITEM', item);
        setCookie()
    },
    removeItemFromCart({commit}, item) {
        commit('REMOVE_FROM_CART', item);
        setCookie()
    },
    clearCart({commit}) {
        commit('CLEAR_CART');
        localStorage.removeItem('cart');
    },
    requestItem({commit}, requestedItem) {
        axios.post('/api/itemrequests', requestedItem).then(result => {
            console.log(result)
        });
    },
    orderCartItems({commit}, userId) {
        let order = {
            user_id: userId,
            cart: JSON.stringify(state.cart)
        };
        axios.post('/api/orders', order).then(result => {
            commit('CLEAR_CART');
            return true;
        }).catch(error => {
            console.log(error);
            return false;
        })
    }
};
const getters = {
    getItems: state => state.items,
    getItemsDashboard: state => state.itemsDashboard,
    getItem(state) {
        return slug => state.items.find(item => {
            return item.slug === slug;
        });
    },
    getItemById: (state) => (id) => {
        return state.items.find(item => item.id === id)
    },
    getCart: state => state.cart,
    getNrItemsOutOfStock: state => state.nrItemsOutOfStock,
    itemInCart: state => item => {
        let selectedItem = state.items.find(stockItem => stockItem.slug === item.slug);
        let selectedSize = selectedItem.stock.find(size => size.size === item.size).id;
        return state.cart.find(cartItem => cartItem.item_id === selectedItem.id && cartItem.size_id === selectedSize);
    }
};

export default {
    state,
    mutations,
    actions,
    getters,
}

function setCookie() {
    let cartItemsString = JSON.stringify(state.cart);
    localStorage.setItem('cart', cartItemsString);
}
