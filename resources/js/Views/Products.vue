<template>
    <div>
        <GoBack/>

        <ProductList
                :listProduct="products.data"
                :withPaginate="true"
                :brand="selectBrand"
                :title="title"
                :logo="null"
        />

    </div>

</template>


<script>

    import ProductList from '../components/ProductList.vue'
    import GoBack from '../components/GoBack.vue'

    import { mapGetters, mapActions } from "vuex";

    export default {

        components: {
            ProductList,
            GoBack
        },
        data() {
            return {
                //   brands: '',
                list: '',
                selectBrand: '',
                banner: null,
                title: '',
                logo: ''
            }
        },


        computed: {
            ...mapGetters(["products"]),
            ...mapGetters(['brands'])
        },

        mounted() {

            console.log(this.$route.params)

            this.getBrand(this.$route.params.id)
        },

        methods: {
            ...mapActions(['GET_ONE_BRAND']),
            getBrand(id) {
                this.selectBrand = id
                this.title = this.$route.params.Brand
                console.log(id)
                let request = {
                    brand: id,
                    page: 1
                }
                this.GET_ONE_BRAND(request)
            }

        }

    }
</script>
