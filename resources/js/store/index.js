import account from './modules/account';
import items from './modules/items';
import orders from './modules/orders';

import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        account,
        items,
        orders
    }
});