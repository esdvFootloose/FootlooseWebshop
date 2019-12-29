import axios from "axios";

const state = {
    cart: [],
    items: [],
    itemsDashboard: [],
    availableSizes: ["XS", "S", "M", "L", "XL", "XXL"],
    nrItemsOutOfStock: 0
};

const mutations = {
    SET_ITEMS(state, items) {
        state.items = items;
    },
    SET_ITEMS_DASHBOARD(state, items) {
        state.itemsDashboard = items;
    },
    SET_ITEMS_OUT_OF_STOCK(state, number) {
        state.nrItemsOutOfStock = number;
    },
    SET_CART(state, cart) {
        state.cart = cart;
    },
    ADJUST_ITEM(state, item) {
        let indexItem = state.cart.indexOf(
            state.cart.filter(
                filterItem =>
                    filterItem.item_id === item.item_id &&
                    filterItem.size_id === item.size_id
            )[0]
        );
        state.cart[indexItem].amount = item.amount;
    },
    CLEAR_CART(state) {
        state.cart = [];
    }
};

const actions = {
    fetchCart({ commit }) {
        axios
            .get("/api/cart")
            .then(result => {
                commit("SET_CART", result.data.data);
            })
            .catch(error => {
                console.error(error);
            });
    },
    fetchItems({ commit }) {
        axios
            .get("/api/items")
            .then(result => {
                commit("SET_ITEMS", result.data.data);
            })
            .catch(error => {
                console.log(error);
            });
    },
    fetchItemsDashboard({ commit }) {
        axios
            .get("/api/itemsDashboard")
            .then(result => {
                commit("SET_ITEMS_DASHBOARD", result.data.data);
                let noStock = state.itemsDashboard.filter(item => {
                    return item.stock.filter(size => size.stock === 0).length;
                }).length;
                commit("SET_ITEMS_OUT_OF_STOCK", noStock);
            })
            .catch(error => {
                console.log(error);
            });
    },
    // Todo Remove console log
    addItemToCart({ commit }, item) {
        axios
            .post("/api/cart", item)
            .then(result => {
                commit("ADD_TO_CART", item);
                console.log("item added to cart");
            })
            .catch(error => {
                console.error(error);
            });
    },
    // Todo Remove console log
    removeItemFromCart({ dispatch }, item) {
        axios
            .delete("/api/cart/", item)
            .then(result => {
                console.log("item removed from cart");
            })
            .catch(error => {
                console.error(error);
            });
        dispatch("fetchCart");
    },
    clearCart({ commit }) {
        commit("CLEAR_CART");
        localStorage.removeItem("cart");
    },
    // TODO remove console log
    requestItem({ commit }, requestedItem) {
        axios.post("/api/itemrequests", requestedItem).then(result => {
            console.log(result);
        });
    },
    orderCartItems({ commit }) {
        axios
            .post("/api/orders", {cart: JSON.stringify(state.cart)})
            .then(result => {
                commit("CLEAR_CART");
                window.location = result.data.data;
                return true;
            })
            .catch(error => {
                console.log(error);
                return false;
            });
    }
};
const getters = {
    getCart: state => state.cart,
    getItem(state) {
        return slug =>
            state.items.find(item => {
                return item.slug === slug;
            });
    },
    getItems: state => state.items,
    itemInCart: state => item => {
        let selectedItem = state.items.find(
            stockItem => stockItem.slug === item.slug
        );
        let selectedSize = selectedItem.stock.find(
            size => size.size === item.size
        ).id;
        return state.cart.find(
            cartItem =>
                cartItem.item_id === selectedItem.id &&
                cartItem.size_id === selectedSize
        );
    },
    getItemById: state => id => {
        return state.items.find(item => item.id === id);
    },
    getItemsDashboard: state => state.itemsDashboard,
    getDashboardItem(state) {
        return slug =>
            state.itemsDashboard.find(item => {
                return item.slug === slug;
            });
    },
    getNrItemsDashboard: state => state.itemsDashboard.length,
    getNrItemsOutOfStock: state => state.nrItemsOutOfStock,
    getAllSizes: state => state.availableSizes
};

export default {
    state,
    mutations,
    actions,
    getters
};
