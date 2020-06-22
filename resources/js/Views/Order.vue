<template>
    <div style="margin-bottom: 100px">
        <GoBack/>
        <div class="container respCont" style="border-bottom: 1px dotted black; margin-bottom: 50px;" >
            <div style="padding: 10px">
                <h1 class="text-center">Votre commande</h1>
            </div>
        </div>




        <section class="container">
            <div class="card">

                <div class="card-body">

                    <article class="d-flex align-items-center">
                        <i style="margin-right: 5px" class="fas fa-user"></i>
                        <span style="font-size: 110%;">
                            {{ order.userInfo}}
                        </span>
                    </article>
                    <article class="d-flex align-items-center">
                        <span style="margin-right: 5px">@</span>
                        <span style="font-size: 110%;">{{ order.userEmail }}</span>

                    </article>
                    <article class="d-flex align-items-center">
                        <i style="margin-right: 5px" class="fas fa-map-marked-alt"></i>
                        <span style="font-size: 110%;">{{ order.userAddress }}</span>
                    </article>

                    <div class="cardCart justify-content-space-between" style="box-shadow: none; border-bottom: 1px dotted black; border-radius: 0px">

                        <div class="d-flex align-items-center" style="width: 100%">
                            <article class="cartName col-5">PRODUIT</article>

                            <!--<article class="cartName col-2">Quantity</article>-->

                            <article class="cartName col-3">
                                <span class="text-capitalize">QUANTITÉ</span>
                            </article>

                            <article class="cartName col-3">
                                <span class="  text-capitalize">TAILLE</span>
                            </article>

                            <article class="cartName col-3">
                                <span class="font-weight-bold">PRIX</span>
                            </article>
                        </div>
                    </div>

                    <div class="cardCart justify-content-space-between"
                         v-for="(prd, index) in productsOrder" :key="index">
                        <div class="col-1">
                            <img class="imageCart" :src="imagePath(prd.products_in_order.image)" style="width: 50px"/>
                        </div>
                        <div class="d-flex align-items-center" style="width: 100%">
                            <article class="cartName col-5">{{ prd.products_in_order.name }}</article>

                            <article class="cartName col-3">{{ prd.quantity}}</article>

                            <!--<article class="col-2">-->
                                <!--<span class="  text-capitalize">Black</span>-->
                            <!--</article>-->

                            <article class="col-3">
                                <span class="  text-capitalize">{{ prd.size }}</span>
                            </article>

                            <article class="col-3">
                                <span class="font-weight-bold">{{ prd.products_in_order.price}} €</span>
                            </article>
                        </div>
                    </div>

                    <div>
                        <div style="padding: 0px 20px" class="d-flex justify-content-between align-items-center priceLine">
                            <article>Nombre d'article : </article>
                            <article style="font-size: 120%; font-weight: bold"> {{ nbArt }} </article>
                        </div>

                        <div style="font-size: 150%; padding: 0px 20px" class="d-flex justify-content-between align-items-center">
                            <span>
                                Total :
                            </span>
                                    <span>
                                {{ order.total}} €
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <ShipForm/>
    </div>
</template>

<style scoped>

    .cardCart {
        display: flex;
        box-shadow: 0px 0px 2px lightgrey;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 5px;
    }
</style>

<script>

    import GoBack from '../components/GoBack.vue'
    import { mapGetters, mapActions } from "vuex";
    import Creditcard from "../components/CreditCard";
    import ShipForm from '../components/ShipForm'
    import axios from 'axios'


    export default {


        props:{
            id:{required: true}
        },

        data(){
            return{
                productsOrder: '',
                order: '',
                nbArt: ''
            }

        },
        components:{
            Creditcard,
            GoBack,
            ShipForm
        },

        computed: {
            ...mapGetters(["cart", "cartCount", "totalCart"]),

        },

        methods:{
            imagePath(elem){
                return elem
            },
        },

        mounted(){
           // console.log(this.$route.params.id)

                axios.get(`/api/order/${this.id}`)
                    .then(response => {
                        console.log(response)
                        this.productsOrder = response.data.products
                        this.nbArt = this.productsOrder.reduce((accum,item) => accum + (item.quantity), 0)
                        this.order = response.data.order
                    })
                    .catch(error => {
                        console.error(error);
                    });
        }

    }
</script>