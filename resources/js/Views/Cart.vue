<template>
    <section>
        <GoBack/>
        <div class="container respCont" style="border-bottom: 1px dotted black; margin-bottom: 50px;" >
            <div style="padding: 10px">
                <h1 class="text-center">Panier</h1>
            </div>
        </div>

        <div class="container mainCart">
            <div>
                <template v-if="cart.length > 0">
                    <div class="cardCart" v-for="(prd, index) in cart" :key="index">
                        <img @click="seeProduct(prd.product.id)" class="imageCart" :src="imagePath(prd.product.image)"/>
                        <div>
                            <article @click="seeProduct(prd.product.id)" class="cartName">{{ prd.product.name }}</article>
                            <div class="forDetal">
                                <article class="detailSize">
                                        <span style="font-weight: lighter; color: lightgrey; margin-right: 10px">
                                        SIZE :
                                        </span>
                                    {{ prd.size }}
                                </article>
                                <article class="cartPrice">{{ prd.product.price}} €</article>
                            </div>


                            <div class="d-flex align-items-center">
                                <span @click="lessQty(prd)" class="buttonQt">-</span>
                                <article class="qtUp">{{ prd.quantity}}</article>
                                <span @click="plusQty(prd)" class="buttonQt">+</span>
                            </div>
                        </div>
                        <div class="forTrash">
                            <i @click="trashInCart(prd)" class="fas fa-trash" style="cursor: pointer"></i>
                        </div>
                    </div>
                </template>
                <article class="noProduct" v-else style="font-size: 150%">
                   Aucun produit dans le panier pour le moment
                </article>
            </div>
            <div class="summaryCart">
                <div class="insideSummary">
                    <article style="font-size: 150%; padding-bottom: 10px">
                        Sommaire
                    </article>
                    <div class="d-flex justify-content-between align-items-center priceLine">
                        <article>Nombre de produits : </article>
                        <article style="font-size: 120%; font-weight: bold"> {{ cartCount }} </article>
                    </div>
                    <div class="d-flex justify-content-between align-items-center priceLine">
                        <article>Sous-total: </article>
                        <article style="font-size: 120%; font-weight: bold"> {{ totalCart }} € </article>
                    </div>
                    <div class="d-flex justify-content-between align-items-center priceLine">
                        <article>Livraison : </article>
                        <article style="font-size: 120%; font-weight: bold"> 0 € </article>
                    </div>
                    <div class="d-flex justify-content-between align-items-center priceLine">
                        <article>Total : </article>
                        <article style="font-size: 120%; font-weight: bold"> {{ totalCart }} € </article>
                    </div>
                    <button @click="goToOrder" :disabled="isDisabled" style="width: 100%; margin-top: 20px" class="btn btn-dark">Commander</button>
                </div>

            </div>
        </div>
    </section>

</template>

<style scoped>



    .qtUp{
        width: 30px;
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #f2f2f2;
    }
    .buttonQt{
        padding: 5px;
        font-size: 120%;
        font-weight: 300;
        background: #f2f2f2;
        width: 30px;
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    .cartPrice{
        font-size: 130%;
        padding: 10px 0px;
    }

    .cartName{
        font-weigth: bold;
        font-size: 120%;
        cursor: pointer;
    }

    .forTrash{
        margin-left: auto;
        padding-left: 20px;
    }
    .cardCart{
        display: flex;
        /*box-shadow: 0px 0px 2px lightgray;*/
        padding: 20px;
        margin-bottom: 20px;
    }

    .cartLeft{
    }

    .rightCart{
    }

    .mainCart{
        margin: auto;
        display: flex;
        justify-content: space-between;
        padding-bottom: 100px;

    }
    .imageCart{
        width:200px;
        margin-right: 20px;
        cursor: pointer;
    }

    .summaryCart{
        width: 300px;
    }

    .insideSummary{
        box-shadow: 0px 0px 2px lightgray;
        padding: 20px;

    }


    .detailSize{
        padding-top: 10px
    }

    @media screen and (max-width: 700px) {


        .noProduct{
            padding: 20px 0px;
        }

        .imageCart{
            width:100px;
            margin-right: 20px;
            height: 60px;
        }


        .mainCart{
            flex-direction: column;
            align-items: center;
        }

        .cartName{
            font-size: 100%;
        }

        .summaryCart{
            width: 90vw;
        }

        .forDetal{
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }


        .cartPrice{
            margin: 0px;
            padding: 0px;
            font-size: 110%;
        }

        .detailSize{
            padding-top: 0px
        }

        .respCont{
            margin-bottom: 20px !important;
        }

        .cardCart{
            padding: 5px;
        }


        .cartName{
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 160px;
        }
    }
</style>
<script>

    import { mapGetters, mapActions } from "vuex";
    import GoBack from '../components/GoBack.vue'



    export default {

        components:{
            GoBack,


        },
        computed: {
            ...mapGetters(["cart", "cartCount", "totalCart"]),
            isDisabled(){
                if(this.cartCount === 0){
                    return true
                }else{
                    return false
                }
            }
        },

        mounted(){
            console.log(this.cart)
        },

        methods: {

            ...mapActions(['TRASH_IN_CART', 'ADD_TO_CART', 'UPDATE_QUANTITY_PLUS','UPDATE_QUANTITY_LESS']),

            imagePath(elem){
                return elem
            },

            plusQty(elem){
                console.log(elem)
                this.UPDATE_QUANTITY_PLUS(elem)
                this.ADD_TO_CART(this.cart)

            },

            lessQty(elem){
                console.log(elem)
                this.UPDATE_QUANTITY_LESS(elem)
                this.ADD_TO_CART(this.cart)
            },

            trashInCart(elem){
                console.log(elem)
                this.TRASH_IN_CART(elem)
                this.ADD_TO_CART(this.cart)
            },

            seeProduct(elem){
                this.$router.push({path: `/Product/${elem}`})
            },
            goToOrder(){
                if (this.cartCount === 0){
                    this.$snotify.error("Please select size ")
                    return
                }
                this.$router.push({path: `/Deliver`})
            }
        }
    }
</script>