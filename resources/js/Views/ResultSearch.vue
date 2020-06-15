<template>
    <div>
        <template v-if="products.data.length > 0">
            <ProductList
                    :listProduct="products.data"
                    :withPaginate="true"
                    :brand="null"
                    title="Results"
                    :logo="null"
            />
        </template>
        <template v-else>
            <div style="padding-top: 100px; text-align: center; font-size: 180%">
               Oops no results . . .
            </div>
        </template>

    </div>
</template>

<script>

    import ProductList from '../components/ProductList.vue'
    import { mapGetters, mapActions } from "vuex";

    export default {
        components: {
            ProductList
        },

        computed: {

            ...mapGetters(["products"]),

        },

    }
</script>
