<template>
    <div>
    <div class="mainDeliver" v-if="!okOrder">
        <div class="leftDeliver">
            <template v-if="!readyPayment">
                <div class="forReveal">
                    <div  class="coordForm">
                        <div class="d-flex align-items-center justify-content-between coordTilt">
                            <article style="font-size: 120%">
                                Coordonnées
                            </article>
                            <article v-if="!user">
                                Vous avez un compte?
                                <router-link style="margin-left: 5px" :to="{ path: '/Login' }">Connectez-vous ici</router-link>
                            </article>
                        </div>

                        <div style="padding-top: 15px;" class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        @
                                    </span>
                                </div>
                            <input :class="{'is-invalid' : $v.userForm.email.$error}"
                                   v-model.trim="userForm.email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div style="height: 23px">
                                <div   v-if="$v.userForm.email.$error">
                                    <small class="error" v-if="!$v.userForm.email.required">Email obligatoire</small>
                                    <small class="error" v-if="!$v.userForm.email.email">Entrez une adresse valide</small>
                                </div>
                            </div>
                        </div>

                        <div style="padding-top: 30px">
                            <article style="font-size: 120%; padding-bottom: 15px">Adresse de livraison</article>
                            <div class="form-group d-flex justify-content-between">
                                <div style="width: 49%" >
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                    <input v-model.trim="userForm.firstname" :class="{'is-invalid' : $v.userForm.firstname.$error}" class="form-control" type="text" placeholder="Prénom"/>
                                    </div>
                                    <div style="height: 23px">
                                        <div   v-if="$v.userForm.firstname.$error">
                                            <small class="error" v-if="!$v.userForm.firstname.required">Le prénom est obligatoire</small>
                                        </div>
                                    </div>
                                </div>

                                <div style="width: 49%" >
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                    <input v-model.trim="userForm.name" :class="{'is-invalid' : $v.userForm.name.$error}" class="form-control" type="text" placeholder="Nom"/>
                                    </div>
                                    <div style="height: 23px">
                                        <div   v-if="$v.userForm.name.$error">
                                            <small class="error" v-if="!$v.userForm.name.required">Le nom est obligatoire</small>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                            <span class="input-group-text">
                                               <i class="fas fa-map-marked-alt"></i>
                                            </span>
                                    </div>
                                <input v-model.trim="userForm.adress" :class="{'is-invalid' : $v.userForm.adress.$error}"  class="form-control" type="text" placeholder="Adresse"/>
                                </div>
                                <div style="height: 23px">
                                    <div   v-if="$v.userForm.adress.$error">
                                        <small class="error" v-if="!$v.userForm.adress.required">L'adresse est obligatoire</small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group d-flex justify-content-between">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                            <span class="input-group-text">
                                               <i class="fas fa-info-circle"></i>
                                            </span>
                                    </div>
                                    <input  class="form-control" type="text" placeholder="Complement d'adresse"/>
                                </div>
                            </div>

                            <div style="padding: 12px 0px" class="form-group d-flex justify-content-between">
                                <div style="width: 20%">
                                    <input v-model.trim="userForm.postalCode" :class="{'is-invalid' : $v.userForm.postalCode.$error}"
                                           class="form-control" type="text" placeholder="Code postal"
                                           maxlength="5"
                                    />

                                    <div style="height: 23px">
                                        <div   v-if="$v.userForm.postalCode.$error">
                                            <small class="error" v-if="!$v.userForm.adress.minLength">5 chiffres obligatoire</small>
                                        </div>
                                    </div>
                                </div>
                                <div style="width: 56%">
                                    <input v-model.trim="userForm.city" :class="{'is-invalid' : $v.userForm.city.$error}" class="form-control" type="text" placeholder="Ville"/>
                                    <div style="height: 23px">
                                        <div   v-if="$v.userForm.city.$error">
                                            <small class="error" v-if="!$v.userForm.city.required">La ville est  oligatoire</small>
                                        </div>
                                    </div>
                                </div>

                                <div style="width: 20%">
                                    <select   v-model.trim="userForm.country" :class="{'is-invalid' : $v.userForm.country.$error}"    class="browser-default custom-select">
                                        <option selected value="">Pays </option>
                                        <option value="1">France</option>
                                        <option value="2">England</option>
                                        <option value="3">Spain</option>
                                    </select>
                                    <div style="height: 23px">
                                        <div   v-if="$v.userForm.country.$error">
                                            <small class="error" v-if="!$v.userForm.country.required">La pays est  oligatoire</small>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div style="padding: 30px 0px" class="d-flex align-items-center justify-content-between">
                            <router-link :to="{ path: '/Cart' }" >Retour au panier</router-link>
                            <button @click="trySubmit()" class="btn btn-dark">Passer au paiement</button>
                        </div>

                    </div>
                </div>

            </template>


            <template v-if="readyPayment" >
                <div class="forReveal">
                    <BankInfo @returnOrder="returnOrder" @paymentOk="goOrder"/>
                </div>

            </template>

        </div>
        <div class="rightDeliver">
            <div class="orderSmry"
                 v-for="(prd, index) in cart" :key="index">
                <div style="position: relative;">
                    <div class="behindImage">
                        <img class="imgSum" :src="imagePath(prd.product.image)"/>
                    </div>

                    <span class="qty">
                        {{ prd.quantity}}
                    </span>
                </div>
                <div class="insideSummary">
                    <div>
                        <article style="">
                            {{ prd.product.name }}

                        </article>
                        <article class="forSize">
                          Taille:   {{ prd.size }}
                        </article>
                    </div>
                </div>
                <article class="forPriceDel" style="margin-left: auto; font-weight: bold">
                    {{ prd.product.price}} €
                </article>
            </div>

            <div class="subTot">
                <div class="d-flex justify-content-between align-items-center">
                    <article>
                        Sous-total :
                    </article>
                    <article>
                        {{ totalCart}} €
                    </article>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <article>
                        Livraison :
                    </article>
                    <article>
                        0 €
                    </article>
                </div>
            </div>
            <div  style="padding-top: 20px" class="d-flex justify-content-between align-items-center sizeTo">
                <div>
                    <article>
                        Total :
                    </article>
                    <article class="forSize">
                        Taxes comprises
                    </article>
                </div>
                <article style="font-size: 150%">
                    {{ totalCart}} €
                </article>
            </div>

        </div>
    </div>
        <template v-else>
            <div class="forReveal">
                <Order :id="idOrder"/>
            </div>
        </template>
    </div>

</template>


<style scoped>

    .coordForm{
        width: 600px;

    }

    .forReveal{
        animation: test ease-in-out 1s forwards;
        opacity: 0;
    }

    @keyframes test {
        from{
            opacity: 0;
        }
        to{
            opacity: 1;
        }
    }

    .subTot{
        width: 80%;
        padding: 20px 0px;
        border-top: 1px solid lightgrey;
        border-bottom: 1px solid lightgrey;
    }

    .forSize{
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-weight: lighter;
        color: black;
    }
    .behindImage{
        background-color: white;
        padding: 10px 5px;
        border-radius: 5px;
    }

    .insideSummary{
        display: flex;
        margin-left: 15px;
    }
    .qty{
        font-size: 0.85714em;
        font-weight: 500;
        line-height: 1.75em;
        white-space: nowrap;
        text-align: center;
        border-radius: 1.75em;
        background-color: rgba(114,114,114,0.9);
        color: #fff;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        min-width: 1.75em;
        height: 1.75em;
        padding: 0 0.58333em;
        position: absolute;
        right: -0.75em;
        top: -0.75em;
        z-index: 3;
    }

    .orderSmry{
        display: flex;
        align-items:center;
        width: 80%;
        padding: 10px 10px;
    }
    .mainDeliver{
        width: 100vw;
        display: flex;
        min-height: 90vh;
    }

    .sizeTo{
        width: 80%;
    }

    .leftDeliver{
        width: 60%;
        padding-top: 50px;
        padding-right: 20px;
        display: flex;
        justify-content: flex-end;
    }

    .rightDeliver{
        width: 40%;
        background-color: #FAFAFA;
        border-left: 1px solid lightgrey;
        padding-top: 50px;
        padding-left: 20px;
    }

    .imgSum{
        width: 60px;
    }

    @media screen and (max-width: 800px) {

        .mainDeliver{
            display: flex;
            flex-direction: column-reverse;
            padding-top: 87px;
        }

        .leftDeliver{
            width: 100%;
            padding: 20px;

        }

        .rightDeliver{
            width: 100%;

            padding: 20px;

        }

        .forPriceDel{
            font-size: 80%;
        }
        .subTot{
            width: 100%;
        }
        .orderSmry{
            width: 100%;
        }
        .sizeTo{
            width: 100%;
        }
        .coordForm{
            width: 90vw;
            margin: auto;
        }

        .coordTilt{
            display: block !important;
        }
    }
</style>
<script>
    import { mapGetters, mapActions } from "vuex";
    import { required, email, minLength, maxLength, numeric } from 'vuelidate/lib/validators'
    import axios from 'axios'

    import BankInfo from '../components/BankInfo.vue'
    import Order from '../views/Order.vue'

    export default {

        components:{
            BankInfo,
            Order
        },

        data(){
            return{
                userForm:{
                    email: '',
                    adress: '',
                    firstname: '',
                    name: '',
                    postalCode: '',
                    city: '',
                    country: '',
                    cartToOrder: '',
                },

                readyPayment: false,
                okOrder: false,
                idOrder: false

            }
        },

        validations: {
            userForm:{
                email: {
                    required, email,
                },

                adress: {
                    required,
                },
                firstname: {
                    required,
                },
                name: {
                    required,
                },
                postalCode: {
                    required,
                    minLength: minLength(5),
                    maxLength: maxLength(5),
                    numeric
                },
                city: {
                    required
                },
                country: {
                    required
                }
            }

        },

        mounted(){


            if(this.cartCount === 0){
                this.$router.push({path: '/'})
            }

            console.log(this.cart)

            this.cartToOrder = {
                total: this.totalCart,
                products : []
            }

            console.log(this.cartToOrder)
            for(let i = 0; i<this.cart.length; i++){
                console.log(this.cart[i])
                this.cartToOrder.products.push({
                   id: this.cart[i].product.id,
                   quantity: this.cart[i].quantity,
                    size: this.cart[i].size

                })
            }

            console.log(this.cartToOrder)

            if(this.user){
                this.userForm.email = this.user.email
                this.userForm.name = this.user.name
                this.userForm.firstname = this.user.firstname
            }

        },


        computed: {
            ...mapGetters(["cart", "cartCount", "totalCart"]),
            ...mapGetters(["user"]),
        },


        methods:{
            ...mapActions(['ADD_TO_CART', 'TRASH_CART']),

            imagePath(elem){
                return elem
            },

            trySubmit(){
                this.$v.$touch()
                if (this.$v.$invalid) {
                    console.log("error")
                    console.log(this.userForm)
                    //   this.$snotify.error("Something wrong !");

                } else {
                    console.log("ok")
                    this.readyPayment = true
                }

            },


            returnOrder(){
                this.readyPayment = false
            },



            goOrder(){
                axios.post('api/order', {user:this.userForm, cart: this.cartToOrder})
                    .then(response => {
                        console.log(response)
                        this.idOrder = response.data.order.id
                        this.okOrder = true
                        this.$snotify.success("Votre commande a bien été enregistré");
                        this.TRASH_CART()
                        this.ADD_TO_CART(this.cart)
                    })
                    .catch(error => {
                        console.error(error);
                        this.$snotify.error("Something wrong !");

                    });
            }
        }
    }
</script>
