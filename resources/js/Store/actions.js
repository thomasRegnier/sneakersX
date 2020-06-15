import axios from 'axios'

import router from '../app.js'
axios.defaults.withCredentials = true;

let actions = {
    GET_NEWS({commit}) {
        axios.get('/api/news')
            .then(res => {
                {
                    console.log(res.data)
                    commit('GET_NEWS', res.data)
                }
            }).catch(err => {
            console.log(err)
        })
    },

    GET_PRODUCTS({commit}, page) {
        page = page || 1
        axios.get(`/api/products?page=${page}`)
            .then(res => {
                {
                    console.log(res.data)
                    commit('GET_PRODUCTS', res.data)
                }
            }).catch(err => {
            console.log(err)
        })
    },

    GET_RANDOM_PRODUCTS({commit}) {
        axios.get('/api/products?sort=random&max=6')
            .then(res => {
                {
                    console.log(res.data)
                    commit('GET_PRODUCTS', res.data)

                }
            }).catch(err => {
            console.log(err)
        })
    },

    GET_BRANDS({commit}) {
        axios.get(`/api/brands`)
            .then(res => {
                {
                    console.log(res.data)
                    commit('GET_BRANDS', res.data)
                }
            }).catch(err => {
            console.log(err)
        })
    },

    GET_ONE_BRAND({commit}, param){
        console.log(param)
        axios.get(`/api/products/?brand=${param.brand}&page=${param.page}`)
            .then(res => {
                {
                    console.log(res.data)
                    commit('GET_PRODUCTS', res.data)

                }
            }).catch(err => {
            console.log(err)
        })
    },

    GET_SEARCH_PRODUCTS({commit}, query) {
        axios.get(`/api/products?search=${query.query}&page=${query.page}`)
            .then(res => {
                {
                    console.log(res.data)
                    commit('GET_PRODUCTS', res.data)
                }
            }).catch(err => {
            console.log(err)
        })
    },

    SET_SEARCH({commit}, query){
        commit('GET_SEARCH', query)
    },

    INIT_CART({commit}){
        let cart =  JSON.parse(localStorage.getItem('cart')) || []
        commit('GET_CART', cart)
    },

    PUSH_IN_CART({commit}, param){
        commit('PUSH_IN_CART', param)
    },

    ADD_TO_CART({commit}, elem){
        localStorage.setItem('cart', JSON.stringify(elem))
        commit('GET_CART', elem)
    },

    TRASH_IN_CART({commit}, elem){
        commit('TRASH_IN_CART', elem)
    },

    UPDATE_QUANTITY_PLUS({commit} ,elem){
       elem.quantity = elem.quantity + 1
    },


    UPDATE_QUANTITY_LESS({commit} ,elem){
        if(elem.quantity === 1){
            commit('TRASH_IN_CART', elem)
        } else{
            elem.quantity = elem.quantity - 1
        }
    },

    TRASH_CART({commit}){
        commit('TRASH_ALL_CART')
    },

    REGISTER_USER({commit} , user){
        return new Promise((resolve, reject) => {
            axios.post('api/register', user)
                .then(response => {
                    //Initialize CSRF protection for the application

                    commit('SET_USER', response.data.user)
                    resolve(response)

                    axios.get('/sanctum/csrf-cookie').then(response => {
                        console.log(response)
                        console.log("ok token")
                    })
                })
                .catch(error => {
                    console.error(error);
                    reject(error)

                });
        })
    },


    GET_COOKIE(){
        return new Promise((resolve, reject) => {
            axios.get('/sanctum/csrf-cookie').then(response => {
                // Login...
                console.log(response)
                resolve(response)
            }).catch(function (error) {
                reject(error)
            })
        })



    },

   LOGIN_USER({commit} , user){
      // actions.GET_COOKIE()
           return new Promise((resolve, reject) => {
                   axios.post('/api/login', user).then(response => {
                    commit('SET_USER', response.data.user)
                       resolve(response)

                }).catch(function (error) {
                       reject(error)
                   })
           })
    },


   LOGOUT_USER({commit}){
       return new Promise((resolve, reject) => {
           axios.post('/api/logout', this.user).then(response => {
               console.log(response)
               commit('SET_USER', null)
               resolve(response)
           })
       })
    }


}
export default actions