import VueRouter from 'vue-router'

import Home from '../views/Home'
import Checkout from '../views/Checkout';
import Dashboard from '../views/Dashboard';
import Item from '../views/Item';
import ItemRequests from '../views/ItemRequests';
import Order from '../views/Order';
import Orders from '../views/Orders';
import Stock from '../views/Stock';
import Stocks from '../views/Stocks';

const index = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Home
        },
        {
            path: '/checkout',
            component: Checkout
        },
        {
            path: '/dashboard',
            component: Dashboard
        },
        {
            path: '/item/:slug',
            component: Item
        },
        {
            path: '/item-requests',
            component: ItemRequests
        },
        {
            path: '/order/:id',
            component: Order
        },
        {
            path: '/orders',
            component: Orders
        },
        {
            path: '/stock/:slug',
            component: Stock
        },
        {
            path: '/stocks',
            component: Stocks
        }
    ]
});

export default index;