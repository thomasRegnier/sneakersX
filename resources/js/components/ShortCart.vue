<template>
    <div class="mainShortCart">
        <div class="cartOver">
            <template v-if="cart.length > 0">
                <div class="cardCart" v-for="(prd, index) in cart" :key="index">
                    <img @click="seeProduct(prd.product.id)" class="imageCart" :src="imagePath(prd.product.image)"/>
                    <div>
                        <article @click="seeProduct(prd.product.id)" class="cartName">{{ prd.product.name }}</article>
                        <article class="d-flex justify-content-between align-items-center">
                            <article>
                                <span style="font-weight: lighter; color: lightgrey; margin-right: 10px">Size :</span>
                                {{ prd.size }}
                            </article>
                        </article>

                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <span @click="lessQty(prd)" class="buttonQt">-</span>
                                <article class="qtUp">{{ prd.quantity}}</article>
                                <span @click="plusQty(prd)" class="buttonQt">+</span>
                            </div>
                            <article class="cartPrice">{{ prd.product.price}} €</article>
                        </div>


                    </div>
                    <div class="forTrash">
                        <i @click="trashInCart(prd)" class="fas fa-trash" style="cursor: pointer"></i>
                    </div>
                </div>
            </template>
            <article v-else class="text-center" style="font-size: 90%; padding: 10px">
                No product in your cart
            </article>
        </div>

        <div class="d-flex justify-content-between align-items-center priceLine" style="padding: 15px; border-top: 1px solid lightgrey">
            <article>Total : </article>
            <article style="font-size: 120%; font-weight: bold"> {{ totalCart }} € </article>
        </div>
        <div style="padding: 0px 20px 20px 20px">
            <button @click="goCart" style="width: 100%" class="btn btn-dark">Go cart</button>
        </div>
    </div>
</template>



<style scoped>

    .cartOver{
        max-height: 400px;
        overflow-y: scroll;
        overflow-x: hidden;
        overscroll-behavior-x: contain;
        scroll-snap-type: x mandatory;
    }

.mainShortCart{
    width: 100%;
    box-shadow: 0px 0px 2px lightgrey;
    /*position: absolute;*/
    /*right: 0px;*/
    background: white;
}

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
        font-size: 100%;
        font-weight: bold;
    }

    .cartName{
        font-weigth: bold;
        font-size: 90%;
        cursor: pointer;
        width: 215px;
    }

    .forTrash{
        margin-left: auto;
        padding-left: 10px;
    }
    .cardCart{
        display: flex;
        padding: 20px;
        border-bottom: 1px solid lightgrey;
        scroll-snap-align: center;

    }

    .cartLeft{
    }

    .rightCart{
    }

    .mainCart{
        margin: auto;
        display: flex;
        justify-content: space-between;
    }
    .imageCart{
        width: 90px;
        height: 60px;
        margin-right: 20px;
        cursor: pointer;
        align-self: center;
        justify-self: center;
    }

    .summaryCart{
        width: 300px;
    }

    .insideSummary{
        box-shadow: 0px 0px 2px lightgray;
        padding: 20px;

    }
</style>

<script>

    import { mapGetters, mapActions } from "vuex";

    export default {
        name: 'ShortCart',

        computed: {
            ...mapGetters(["cart", "cartCount", "totalCart"])
        },

        mounted(){
            console.log(this.cart)
        },

        methods: {

            ...mapActions(['TRASH_IN_CART', 'ADD_TO_CART',  'UPDATE_QUANTITY_PLUS','UPDATE_QUANTITY_LESS']),

            imagePath(elem){
                return '/storage/images/'+elem
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

            goCart(){
                this.$router.push({path: `/Cart`})
            }
        }
    }
</script>