import VueRouter from 'vue-router'

import store from '../store/index'

import Home from '../views/Home'
import Checkout from '../views/Checkout';
import Dashboard from '../views/Dashboard';
import Item from '../views/Item';
import Order from '../views/Order';
import ItemRequests from '../views/ItemRequests';
import OrderSummary from '../views/OrderSummary';
import Orders from '../views/Orders';
import Stock from '../views/Stock';
import Stocks from '../views/Stocks';
import Login from "../views/Login";

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'navbar__menu-item--active',
    routes: [
        {
            path: '/login',
            component: Login,
            name: 'login'
        },
        {
            path: '/',
            component: Home,
            name: 'home',
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/checkout',
            component: Checkout,
            name: 'checkout',
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/dashboard',
            component: Dashboard,
            name: 'dashboard',
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/item/:slug/:size?',
            component: Item,
            name: 'item',
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/item-requests',
            component: ItemRequests,
            name: 'item-requests',
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/order/:id',
            component: OrderSummary,
            name: 'ordersummary',
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/orders/:query?',
            component: Orders,
            name: 'orders',
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/stock/:slug?',
            component: Stock,
            name: 'stock',
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/stocks/:query?',
            component: Stocks,
            name: 'stocks',
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/cart',
            component: Checkout,
            name: 'cart',
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/order/edit/:id',
            component: Order,
            name: 'order',
            meta: {
                requiresAuth: true,
            }
        }
    ]
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!store.getters.isLoggedIn) {
            next({name: 'login'});
            return;
        }
        if (!store.getters.isUserLoaded) {
            store.dispatch('getUser');
        }
        if (store.getters.getItems.length === 0) {
            store.dispatch('fetchItems');
        }
    }
    window.scrollTo(0, 0);
    next();
});

export default router;
