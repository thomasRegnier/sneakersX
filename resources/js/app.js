require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import Vue from 'vue'
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)
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
import Brands from './Views/Brands.vue'
import MyFoot from './components/MyFoot.vue'
import ResultSearch from './Views/ResultSearch.vue'
import Cart from './Views/Cart.vue'
import Products from './Views/Products.vue'
import Deliver from './Views/Deliver.vue'
import Page404 from './Views/Page404.vue'
import Contact from './Views/Contact.vue'
import AdminHome from './Views/AdminHome.vue'
import AdminActu from './Views/AdminActu.vue'
import ActuForm from './Views/ActuForm.vue'
import AdminBrand from './Views/AdminBrand.vue'
import BrandForm from './views/BrandForm.vue'
import AdminProducts from "./Views/AdminProducts"
import ProductForm from "./Views/ProductForm"

//store.dispatch("GET_NEWS");
store.dispatch("INIT_CART")

import Snotify from 'vue-snotify'; // 1. Import Snotify
import 'vue-snotify/styles/material.css'; // or dark.css or simple.css

// 2. Use Snotify
// You can pass {config, options} as second argument. See the next example or setConfig in [API] section
Vue.use(Snotify)




const ifNotAuthenticated = (to, from, next) => {
    if (!store.state.user) {
        next()
        return
    }
    next('/')
}

const isAdmin = (to, from, next) => {
    if(store.state.user){
        if (store.state.user.isAdmin) {
            next()
            return
        }
    }

    next('/')
}


    const router =  new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'Home',
            component: Home,
            meta: {
                title: "Home"
            }
        },
        {
            path: '/login',
            name: 'Login',
            component: Login,
            beforeEnter: ifNotAuthenticated,
            meta: {
                title: "Login"
            }
        },
        {
            path: '/Register',
            name: 'Register',
            component: Register,
            beforeEnter: ifNotAuthenticated,
            meta: {
                title: "Register"
            }
        },

        {
            path: '/News',
            name: 'News',
            component: News,
            meta: {
                title: "News"
            }
        },

        {
            path: '/News/:id',
            name: 'OneNews',
            component: OneNews,
            meta: {
                title: "News"
            }
        },
        {
            path: '/Product/:id',
            name: 'Product',
            component: Product,
            meta: {
                title: "Product"
            }
        },

        {
            path: '/Catalogue',
            name: 'Catalogue',
            component: Brands,
            meta: {
                title: "Catalogue"
            }
        },

        {
            path: '/Result',
            name: 'Result',
            component: ResultSearch,
            meta: {
                title: "Results"
            }
        },

        {
            path: '/Cart',
            name: 'Cart',
            component: Cart,
            meta: {
                title: "Cart"
            }
        },

        {
            path: '/Brands/:id/:Brand',
            name: 'Brands',
            component: Products,
            meta: {
                title: "Brand"
            }
        },
        // {
        //     path: '/Order/:id',
        //     name: 'Order',
        //     component: Order,
        //     meta: {
        //         title: "Order"
        //     }
        // },
        {
            path: '/Deliver',
            name: 'Deliver',
            component: Deliver,
            meta: {
                title: "Deliver"
            }
        },
        {
            path: '/Page404',
            name: 'Page404',
            component: Page404,
            meta: {
                title: "404"
            }
        },
        {
            path: '/Contact',
            name: 'Contact',
            component: Contact,
            meta: {
                title: "Contact"
            }
        },
        {
            path: '/AdminHome',
            name: 'AdminHome',
            component: AdminHome,
            beforeEnter: isAdmin,
            meta: {
                title: "Admin"
            }
        },
        {
            path: '/AdminActu',
            name: 'AdminActu',
            component: AdminActu,
            beforeEnter: isAdmin,
            meta: {
                title: "Admin Actu"
            }
        },
        {
            path: '/ActuForm',
            name: 'ActuForm',
            component: ActuForm,
            beforeEnter: isAdmin,
            meta: {
                title: "Ajouter une actu"
            }
        },
        {
            path: '/ActuForm/:id',
            name: 'ActuForm',
            component: ActuForm,
            beforeEnter: isAdmin,
            meta: {
                title: "Modifier une actu"
            }
        },
        {
            path: '/AdminBrand',
            name: 'AdminBrand',
            component: AdminBrand,
            beforeEnter: isAdmin,
            meta: {
                title: "Admin Marques"
            }
        },
        {
            path: '/BrandForm',
            name: 'BrandForm',
            component: BrandForm,
            beforeEnter: isAdmin,
            meta: {
                title: "Ajouter une marque"
            }
        },
        {
            path: '/BrandForm/:id',
            name: 'BrandForm',
            component: BrandForm,
            beforeEnter: isAdmin,
            meta: {
                title: "Modifier une marque"
            }
        },
        {
            path: '/AdminProducts',
            name: 'AdminProducts',
            component: AdminProducts,
            beforeEnter: isAdmin,
            meta: {
                title: "Admin Produits"
            }
        },
        {
            path: '/ProductForm',
            name: 'ProductForm',
            component: ProductForm,
            beforeEnter: isAdmin,
            meta: {
                title: "Ajouter un produit"
            }
        },
        {
            path: '/ProductForm/:id',
            name: 'ProductForm',
            component: ProductForm,
            beforeEnter: isAdmin,
            meta: {
                title: "Modifier un produit"
            }
        },
        {
            path: '/*',
            name: 'Page404',
            component: Page404,
            meta: {
                title: "404"
            }
        }
    ],
        scrollBehavior (to, from, savedPosition) {
           return { x: 0, y: 0 }
        }
});

export default router



router.beforeEach((to, from, next) => {
    document.title = "Sneakers-X - "+to.meta.title || 'Sneakers-x'

    next()
})

const app = new Vue({
    components: {
       Navbar,
       MyFoot
    },
    el: '#app',
    router,
    store
});
