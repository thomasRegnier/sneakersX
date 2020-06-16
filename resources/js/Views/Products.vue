<template>
    <div>
        <GoBack/>

        <div v-if="products.data.length > 0">
            <ProductList
                :listProduct="products.data"
                :withPaginate="true"
                :brand="selectBrand"
                :title="title"
                :logo="null"
            />
        </div>
        <div v-else>
            <div style="width: 100vw; height: 60vh; display: flex; align-items: center; justify-content: center;">
                <div style="text-align: center">
                    <h1>
                        {{ title }}
                    </h1>
                    <article>
                        Les produits arrivent bientot !
                    </article>
                </div>
            </div>
        </div>


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
