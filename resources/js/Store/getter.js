let getters = {
    news: state => {
        return state.news
    },

    products : state => {
        return state.products
    },

    brands : state => {
        return state.brands
    },

    search : state => {
        return state.search
    },

    cart : state => {
        return state.cart
    },

    cartCount : state => {
        return state.cart.reduce((accum,item) => accum + (item.quantity), 0)

    },
    totalCart : state => {
        return state.cart.reduce((accum,item) => accum + (item.product.price * item.quantity), 0)
    },

    user: state =>{
        return state.user
    }
}
export default getters