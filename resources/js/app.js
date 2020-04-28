require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import moment from 'moment'
import 'moment/locale/fr'  // without this line it didn't work

Vue.prototype.moment = moment

import store from "./Store"

import Navbar from './components/Navbar.vue'
import Home from './Views/Home.vue'
import Register from './Views/Register.vue'
import Login from './Views/Login.vue'
import News from './Views/AllNews.vue'
import OneNews from './Views/OneNews.vue'
import Product from './Views/Product.vue'


//store.dispatch("GET_NEWS");

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'Home',
            component: Home
        },
        {
            path: '/login',
            name: 'Login',
            component: Login
        },
        {
            path: '/Register',
            name: 'Register',
            component: Register
        },

        {
            path: '/News',
            name: 'News',
            component: News
        },

        {
            path: '/News/:id',
            name: 'OneNews',
            component: OneNews
        },
        {
            path: '/Product',
            name: 'Product',
            component: Product
        },
        // {
        //     path: '/*',
        //     name: '',
        //     component: Home
        // },
    ],
});



const app = new Vue({
    components: {
       Navbar
    },
    el: '#app',
    router,
    store
});
