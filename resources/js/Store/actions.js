import axios from 'axios'

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
    }
}
export default actions