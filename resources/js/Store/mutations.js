let mutations = {
    GET_NEWS(state, news) {
        state.news = news
    },

    GET_PRODUCTS(state, products){
        state.products = products
    },

    GET_BRANDS(state, brands){
        state.brands = brands
    },
    GET_SEARCH(state, search){
        state.search = search
    },
    GET_CART(state, cart){
        state.cart = cart
    },

    PUSH_IN_CART(state, param){
        console.log(param)
        const found = state.cart.find(element => (element.product.id === param.product.id && element.size === param.size ));
        if(found){
            found.quantity += 1
        }else{
            state.cart.push(param)
        }
    },

    TRASH_IN_CART(state, param){
        state.cart.splice(state.cart.findIndex(note =>  note.product.id === param.product.id), 1)
    },

    SET_USER(state, user){
        state.user = user
    },

    TRASH_ALL_CART(state){
        state.cart = [ ]
    }
}
export default mutations