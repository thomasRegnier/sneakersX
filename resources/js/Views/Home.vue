<template>
    <div>
        <!--<div>-->
            <!--<HomeCarrousel/>-->
        <!--</div>-->
        <div class="forHome">
            <div class="homeLeft">
                <HomeCarrousel/>
                <!--<div class="toLogo">Sneakers-x</div>-->
                <!--<div style="padding-top: 10px">-->
                    <!--<router-link :to="{ path: '/Catalogue' }">-->
                        <!--<button class="btnShow">Catalogue</button>-->
                    <!--</router-link>-->

                <!--</div>-->
            </div>
            <div class="homeRight">
                <img src="storage/images/home.jpeg"/>
            </div>
        </div>
        <!--<LastNews />-->
        <ProductList :listProduct="products.data" :withPaginate="false" title="Trends" :logo="null"/>
    </div>
</template>


<style>

    html {
        scroll-behavior: smooth;
    }

    .btnShow{
        background-color: black;
        border: none;
        padding: 10px 15px;
        box-shadow: 0px 0px 2px lightgrey;
        color: white;
        font-weight: bold;
        border-radius: 5px;
        outline: none !important;
        transition: background ease-in-out 0.2s;
    }

    .btnShow:hover{
        background-color: #0c0c0c;
        box-shadow: 0px 0px 5px lightgrey;


    }


    .toLogo{
        font-size: 250%;
        font-family: 'Marck Script', cursive;

    }

    .forHome{
        width: 100vw;
        height: 60vh;
        display: flex;
    }

    .homeLeft{
        background: black;
        color: white;
        width: 50vw;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .homeRight{
        width: 50vw;
    }


    .homeRight img{
        width: 100%;
        height: 60vh;
    }
    body{
        background-color: white !important;
    }

    .randomTitle{
        width: 90vw;
        border-bottom: 1px dotted black;
        margin: 50px auto 50px;
        padding: 10px;
    }

    @media screen and (max-width: 700px) {

        .forHome{
            padding-top: 86px;
        }

        .homeRight{
              display: none;
          }

        .homeLeft{
            width: 100vw;
            height: 50vh;
        }
    }


</style>

<script>
    import LastNews from '../components/LastNews.vue'
    import axios from 'axios'
    import ProductList from '../components/ProductList.vue'
    import HomeCarrousel from '../components/HomeCarrousel'

    import { mapGetters, mapActions } from "vuex";

    export default {

        components: {
            LastNews,
            ProductList,
            HomeCarrousel
        },

        data(){
            return{
                list: ''
            }
        },


        mounted(){

         //   this.getRandomProducts(),

            this.GET_RANDOM_PRODUCTS()
        },

        computed: {
            ...mapGetters(["products"]),
        },

        methods: {

            ...mapActions(['GET_RANDOM_PRODUCTS']),

            //
            // getRandomProducts(){
            //     axios.get('/api/products?sort=random&max=6')
            //         .then(res => {
            //             {
            //                 console.log(res.data)
            //                 this.list = res.data
            //             }
            //         }).catch(err => {
            //         console.log(err)
            //     })
            // },
        }

    }
</script>
