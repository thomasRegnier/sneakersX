<template>
    <div>
        <!--<div class="container">-->
            <!--<div class="forBrands" >-->
                <!--<span-->
                        <!--class="allBrand"-->
                        <!--@click="getAllProduct"-->
                <!--&gt;-->
                    <!--All products-->
                <!--</span>-->
                <!--<img-->
                        <!--v-for="(brand, index) in brands"-->
                        <!--:key="index" class="brandLogo"-->
                        <!--:src="imagePath(brand.logo)"-->
                        <!--@click="getBrand(brand.id, brand)"-->
                <!--/>-->
            <!--</div>-->
        <!--</div>-->

        <div class="randomTitle">
            <h1 class="text-center d-flex justify-content-center align-items-center">
                Nos marques
            </h1>
        </div>

        <div class="containerMobileBrand">
            <div class="forBrandMobile">
                <div class="insideMobileBrand"
                     @click="getAllProduct"
                     :class="{ selected: selectBrand === 'other' }"
                     style="font-size: 120%"
                >
                    Tout les produits
                </div>
                <div class="insideMobileBrand" v-for="(brand, index) in brands"
                     @click="getBrand(brand.id, brand)"
                     :class="{ selected: selectBrand === brand.id }"

                     :key="index">
                    <img  :src="imagePath(brand.logo)"/>
                    <!--<article>{{brand.name}}</article>-->
                </div>
            </div>
        </div>




        <!--<ProductList :listProduct="list"/>-->

        <!--<ProductList :listProduct="products"/>-->

        <!--<ProductList-->
                <!--:listProduct="products.data"-->
                <!--:withPaginate="true"-->
                <!--:brand="selectBrand"-->
                <!--:title="title"-->
                <!--:logo="logo"-->
        <!--/>-->




    </div>
</template>

<style scoped>
    .containerMobileBrand{
        min-height: calc(100vh - 300px);
        padding-bottom: 100px;

    }
    .forBrandMobile{
        display: flex;
        width: 800px;
        margin: auto;
        flex-wrap: wrap;
    }


    .insideMobileBrand{
        width: 400px;
        height: 200px;

        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 1px 1px 3px rgba(0,0,0,0.2);
        padding: 10px;
        cursor: pointer;
    }


    .forBrandMobile img{
        width: 90px;
    }

    .selected{


    }


    .allBrand{
        font-size: 20px;
        cursor: pointer;
    }

    .forBrands{
        padding-top: 50px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        overflow-x: scroll;
        overflow-y: hidden;
        overscroll-behavior-x: contain;
        scroll-snap-type: x mandatory;
    }
    .brandLogo{
        width: 80px;
        margin: 10px;
        scroll-snap-align: center;
        cursor: pointer;
    }

    @media screen and (max-width: 800px) {

        .forBrandMobile {

            width: 100vw;
            flex-direction: column;
        }

        .insideMobileBrand{
            width: 100%;

        }

        .forBrands{
            padding-top: 120px;
            padding-bottom: 50px;
        }

        .brandLogo{
            width: 50px;
        }

        .randomTitle{
            padding-top: 90px;
        }
    }

</style>
<script>
    import axios from 'axios'
    import { mapGetters, mapActions } from "vuex";

    import ProductList from '../components/ProductList.vue'


    export default {

        components: {
            ProductList
        },
        data(){
            return{
             //   brands: '',
                list: '',
                selectBrand: 'other',
                banner: null,
                title: 'All products',
                logo: ''
            }
        },


        computed: {
            ...mapGetters(["products"]),
            ...mapGetters(['brands'])
        },

        mounted(){

            this.$store.dispatch("GET_PRODUCTS");

            this.GET_BRANDS();

       //     this.getAllProduct();
            this.SET_SEARCH(null)
        },




        methods: {
            ...mapActions(['GET_BRANDS']),
            ...mapActions(['GET_ONE_BRAND']),
            ...mapActions(['GET_PRODUCTS']),
            ...mapActions(['SET_SEARCH']),


            getBrand(id, elem){
                this.$router.push({path: `/Brands/${id}/${elem.name}`})
                this.selectBrand = id
                this.title = elem.name
                this.logo = elem.logo
                console.log(id)
                let request = {
                    brand: id,
                    page: 1
                }
                this.GET_ONE_BRAND(request)

            },

            getAllProduct(){
                this.$router.push({path: `/Brands/0/Tous les produits`})

              //   this.selectBrand = 'other'
              //   this.title = 'All products'
              //   this.logo = null
              //   this.GET_PRODUCTS()
            },


            imagePath(elem){
                return elem
            },
        }
    }
</script>