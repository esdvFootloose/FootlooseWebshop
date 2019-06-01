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
import Ordered from "../views/Ordered";
import Login from "../views/Login";

const index = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'navbar__menu-item--active',
    routes: [
        {
            path: '/',
            component: Home,
            name: 'items'
        },
        {
            path: '/checkout',
            component: Checkout,
            name: 'checkout'
        },
        {
            path: '/dashboard',
            component: Dashboard,
            name: 'dashboard'
        },
        {
            path: '/item/:slug',
            component: Item,
            name: 'item'
        },
        {
            path: '/item-requests',
            component: ItemRequests,
            name: 'item-requests'
        },
        {
            path: '/order/:id',
            component: Order,
            name: 'order'
        },
        {
            path: '/orders',
            component: Orders,
            name: 'orders'
        },
        {
            path: '/stock/:slug',
            component: Stock,
            name: 'stock'
        },
        {
            path: '/stocks',
            component: Stocks,
            name: 'stocks'
        },
        {
            path: '/cart',
            component: Checkout,
            name: 'cart'
        },
        {
            path: '/ordered',
            component: Ordered,
            name: 'ordered'
        },
        {
            path: '/login',
            component: Login,
            name: 'login'
        }
    ]
});

export default index;