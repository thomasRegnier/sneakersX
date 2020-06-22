<template>
    <div>
        <GoBack/>
        <div class="forProduct">
            <!--<div class="leftProduct">-->
                <!--<article class="productBrand">{{ product.brand.name }}</article>-->
                <!--<article class="productRef">{{ product.name }}</article>-->
                <!--<article class="productDescription"> {{ product.description }}</article>-->
            <!--</div>-->
            <div class="middleProduct">
                <!--<img :src="imagePath(product.image)"/>-->
                <template v-if="product.images.length > 0">
                    <Carrousel :images="product.images"/>
                </template>
                <template v-else>
                    <img width="100%" :src="product.image" >
                </template>
            </div>
            <div class="rightProduct">
                <!--<article class="productBrand">{{ product.brand.name }}</article>-->
                <div class="d-flex align-items-center justify-content-between">
                    <article style="font-size: 150%">{{ product.brand.name }}</article>
                    <img style="width: 50px" :src="product.brand.logo">
                </div>


                <article class="productRef">{{ product.name }}</article>
                <div style="font-size: 150%; padding-top: 10px; color: black">
                    {{ product.price }} €
                </div>
                <article v-html="product.description" class="productDescription"> {{ product.description }}</article>
                <div style="width: 50%" class="d-flex justify-content-between align-items-center">
                    <article><b>Size</b></article>
                    <!--<select style="width: 30%">-->
                        <!--<option>40</option>-->
                        <!--<option>41</option>-->
                        <!--<option>42</option>-->
                        <!--<option>43</option>-->
                    <!--</select>-->
                </div>
                <div class="d-flex" style="padding-top: 10px">
                   <article class="sizeCirlce" v-for="(size, index) in sizes" @click="clickSize(size)" :class="{ selectedSize: selectSize === size}">
                        {{ size.size }}
                    </article>
                </div>

                <!--<div style="margin-top: 15px">-->
                    <!--<div><b>Color</b></div>-->
                    <!--<div class="d-flex mt-2">-->
                        <!--<button type="button" class="btn btn-success btn-circle"></button>-->
                        <!--<button type="button" class="btn btn-primary btn-circle"></button>-->
                        <!--<button type="button" class="btn btn-danger btn-circle"></button>-->
                    <!--</div>-->
                <!--</div>-->


                <!--<div class="d-flex justify-content-between align-items-center" style="margin-top: 15px; width: 50%">-->
                    <!--<article><b>Price</b></article>-->
                    <!--<article style="font-size: 120%">{{ product.price }} €</article>-->
                <!--</div>-->

                <div style="margin-top: 30px">
                    <button @click="addCart" style="background: black; width: 100%" class="btn btn-dark myBut butResp">
                        AJOUTER AU PANIER
                        <i style="margin-left: 5px; margin-top: -3px" class="fas fa-shopping-bag"></i>
                    </button>
                </div>

                <div style="margin-top: 30px" class="d-flex align-items-center justify-content-between mainLogos">
                    <div class="forLogos">
                        <i class="far fa-check-circle"></i>
                        <article>
                            Produit authentique
                        </article>
                    </div>
                    <div class="forLogos">
                        <i class="fas fa-shipping-fast"></i>
                        <article>
                            Livraison gratuite
                        </article>
                    </div>
                    <div class="forLogos">
                        <i class="fas fa-lock"></i>
                        <article>
                            Paiement sécurisé
                        </article>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<style scoped>

    .mainLogos i{
        font-size: 220%;
        margin-bottom: 5px;
    }

    .forLogos{
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .myBut{
        transition: 0.3s ease-in-out;
    }

    .myBut:active{
        transform: scale(0.8);
    }
    .selectedSize{
        background: black !important;
        color: white !important;
        transition: ease-in-out 0.2s;

    }

    .sizeCirlce{
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        border-radius: 100%;
        background: #f3f3f3;
        margin-right: 10px;
        cursor: pointer;
        transition: ease-in-out 0.2s;
    }

    .sizeCirlce:active{
        box-shadow: 0px 0px 2px grey;
        transform: scale(0.8);

    }
    .forProduct{
        width: 95vw;
        /*box-shadow: 1px 1px 3px rgba(0,0,0,0.4);*/
        margin: 0px auto 15px  auto;
        display: flex;
        padding: 50px;

    }

    .productDescription{
        text-align: justify;
        color: grey;
        padding-top: 10px;
        padding-bottom: 10px;
        font-weight: lighter;

    }

    .productRef{
        font-size: 250%;
        font-weight: bold;
        padding-bottom: 10px;
        border-bottom: 1px dotted lightgrey;

    }

    .productBrand{
        font-weight: bold;
        font-size: 200%;
    }

    .middleProduct{
        width: 60%;
    }

    .middleProduct img{
        width: 100%;
    }
    .leftProduct, .rightProduct{
        width: 40%;

    }

    .secondaryImages{
        display: flex;
        flex-direction: column;
    }

    .leftProduct img{
        width: 150px;
        margin: 5px;
        cursor: pointer;
    }

    .moreActu{
        background-color: #000;
        border: 0;
        border-radius: 3px;
        color: #fff;
        cursor: pointer;
        font-family: 'Open Sans Condensed', sans-serif;
        letter-spacing: 1px;
        line-height: 1;
        padding: 10px 15px;
        cursor: pointer;
        outline: none;
        transition: ease 0.3s;

    }

    .btn-circle.btn-xl {
        width: 70px;
        height: 70px;
        padding: 10px 16px;
        border-radius: 35px;
        font-size: 24px;
        line-height: 1.33;
    }

    .btn-circle {
        width: 30px;
        height: 30px;
        padding: 6px 0px;
        border-radius: 15px;
        text-align: center;
        font-size: 12px;
        line-height: 1.42857;
        margin-right: 10px;
    }


    @media screen and (max-width: 700px) {
       .forProduct{
           flex-direction: column;
           width: 100vw;
           box-shadow: none;
           padding: 10px;
           margin: 0px 0px;


       }

        .middleProduct{
            width: 100%;
        }


        .rightProduct{
            width: 100%;
            padding-top: 10px;
        }

        .butResp{
            width: 100%;
        }
    }

</style>

<script>
    import axios from 'axios'
    import Carrousel from '../components/Carrousel.vue'
    import { mapGetters, mapActions } from "vuex";
    import GoBack from '../components/GoBack.vue'

    export default {

        components:{
            Carrousel,
            GoBack
        },
        data(){
            return{
                selectSize: '',
                product: '',
                sizes: [
                    { size: 40 },
                    { size: 41 },
                    { size: 42 },
                    { size: 43  },
                ]
            }
        },
        mounted(){
            console.log(this.$route.params.id)
            this.getProduct(this.$route.params.id)
        },



        computed: {
            ...mapGetters(["cart"])
        },


        methods: {

            ...mapActions(['ADD_TO_CART', 'PUSH_IN_CART']),

            addCart(){
                if(this.selectSize !== ''){
                    console.log(this.product, this.selectSize)
                    console.log(this.cart)
                    let objectProduct = {
                        product: this.product,
                        size: this.selectSize.size,
                        quantity: 1
                    }

                 //   this.cart.push(objectProduct)
                    this.PUSH_IN_CART(objectProduct)
                    this.ADD_TO_CART(this.cart)
                    this.$snotify.success("Article ajouté au panier ");


                } else{
                    this.$snotify.error("Please select size ");

                }
            },

            clickSize(elem){
             //   elem.select = !elem.select
                this.selectSize = elem

            },
            getProduct(id){
                axios.get(`/api/products/${id}`)
                    .then(res => {
                        {
                            console.log(res.data)
                            this.product = res.data
                        }
                    }).catch(err => {
                    console.log(err)
                    this.$router.push({path:'/Page404'})
                })
            },
            imagePath(elem){
                return '/storage/images/'+elem
            },
        }
    }

</script>
