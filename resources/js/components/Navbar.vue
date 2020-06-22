<template>
    <section>
        <div class="myNav">
            <router-link :to="{ path: '/' }">
            <span
                    class="logo"
                    style="color: black"
            >
                Sneakers-X
            </span>
            </router-link>


            <div v-if="user && user.isAdmin" class="boxAdmin">
               <router-link style="margin-left: 0px" class="forAdminLink" :to="{ path: '/AdminHome' }">
                   Espace ADMIN
               </router-link>
                <router-link :to="{ path: '/AdminActu' }">
                    Actualités
                </router-link>
                <router-link :to="{ path: '/AdminBrand' }">
                    Marques
                </router-link>
                <router-link :to="{ path: '/AdminProducts' }">
                    Produits
                </router-link>
            </div>

            <div class="d-flex align-items-center">
                <div class="form-inline d-flex justify-content-center">
                    <i style="cursor: pointer ;" @click="goSearch" class="fas fa-search" aria-hidden="true"></i>
                    <input class="form-control form-control-sm ml-2 w-75" type="text" placeholder="Search"
                           aria-label="Search"
                           v-model="searchQuery"
                           @keyup.enter="goSearch"
                    >
                </div>

                <router-link :to="{ path: '/News' }" @click="forMenu">Actualités</router-link>
                <router-link :to="{ path: '/Catalogue' }">Catalogue</router-link>
                <router-link :to="{ path: '/Contact' }">Contact</router-link>
                <div v-if="!user">
                    <router-link :to="{ path: '/Login' }">Connexion</router-link>
                    <router-link :to="{ path: '/Register' }">Inscription</router-link>
                </div>
                <div v-else class="toLogout">
                    <article class="nameUser">{{ user.name }}</article>
                    <button class="" @click="logout">Logout</button>
                </div>

                <article  class="shopBasket"
                          @mouseover="mouseOver"
                          @mouseleave="mouseLeave"
                >
                    <i @click="goToCart" style="color: black" class="fas fa-shopping-cart"></i>
                    <span v-if="cartCount > 0" class="circleCount">{{ cartCount }}</span>
                    <div v-if="!hideCart" class="forShortCart">
                        <ShortCart />
                    </div>
                </article>
            </div>
        </div>
        <!--<Creditcard/>-->


        <!--<div class="containerForShort">-->
            <!--<div class="forShortCart">-->
                <!--<ShortCart />-->
            <!--</div>-->
        <!--</div>-->
        <transition name="fade">
            <div v-if="openMenu" @click="forMenu" class="shadow"></div>
        </transition>
        <div class="mobileNav">
            <span class="mobileIcon">
                <i @click="forMenu" class="fas fa-bars"></i>
            </span>
            <router-link :to="{ path: '/' }">
                    <span class="logo"
                          style="color: black">
                        Sneakers-X
                    </span>
            </router-link>
            <span style="position: relative">
                  <i @click="goToCart" class="fas fa-shopping-cart"></i>
                    <span v-if="cartCount > 0" class="circleCount">{{ cartCount }}</span>
            </span>
        </div>
        <div class="smartMenu" :class="{showSmart: openMenu}">
            <div  class="d-flex justify-content-between align-items-center" style="padding: 20px">
                <router-link :to="{ path: '/' }" v-on:click.native="forMenu">
                    <span class="logo"
                          style="color: black">
                        Sneakers-X
                    </span>
                </router-link>
                <i @click="forMenu" style="font-size: 200%" class="fas fa-times"></i>
            </div>
            <div class="insideMobileNav">
                <div class="form-inline d-flex justify-content-center">
                    <i style="cursor: pointer;" @click="goSearch" class="fas fa-search" aria-hidden="true"></i>
                    <input class="form-control form-control-sm ml-2 w-75" type="text" placeholder="Search"
                           aria-label="Search"
                           v-model="searchQuery"
                           @keyup.enter="goSearch"
                    >
                </div>

                <div class="insideMobileNav" style="padding-left: 19px">
                    <router-link :to="{ path: '/' }" v-on:click.native="forMenu">Home</router-link>
                    <router-link :to="{ path: '/News' }" v-on:click.native="forMenu">Actualités</router-link>
                    <router-link :to="{ path: '/Catalogue' }" v-on:click.native="forMenu">Catalogue</router-link>
                    <router-link :to="{ path: '/Contact' }" v-on:click.native="forMenu">Contact</router-link>
                    <div style="padding-top: 10px" v-if="!user">
                        <router-link :to="{ path: '/Login' }" v-on:click.native="forMenu">Connexion</router-link>
                        <router-link :to="{ path: '/Register' }" v-on:click.native="forMenu" >Inscription</router-link>
                    </div>
                    <div style="padding-top: 10px" v-else class="toLogout">
                        <article class="nameUser">{{ user.name }}</article>
                        <button class="" @click="logout">Logout</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>

    .boxAdmin{
        box-shadow: 0px 0px 3px lightgrey;
        padding: 5px;
        border-radius: 5px;
    }

    .insideMobileNav{
        display: flex;
        flex-direction: column;
    }
    .insideMobileNav a{
        padding-top: 10px;
    }

    .insideMobileNav .shopBasket{
        margin-top: 20px;
        text-align: right;
    }
    .shadow{
        width: 100vw;
        height: 100vh;
        background: linear-gradient(153deg, rgba(0,0,0,0.6068802521008403) 0%, rgba(0,0,0,0.8365721288515406) 100%);
        position: fixed;
        top: 0px;
        left: 0px;
        z-index: 999999;
    }
    .nameUser{
        font-weight: bold;
        font-family: 'Marck Script', cursive;
        color: black;
        font-size: 140%;
    }

    .toLogout{

        display: flex;
        align-items: center;

        margin: 0px 10px;
    }

    .toLogout button{
        padding: 5px 10px;
        border-radius: 6px;
        background-color: black;
        color: white;
        margin-left: 10px;
        box-shadow: none;
        border: none;
    }

    .smartMenu{
        width: 80vw;
        height: 100vh;
        background: white;
        box-shadow: 0px 0px 3px lightgrey;
        position: fixed;
        top: 0px;
        left: -90vw;
        z-index: 999999;
        display: none;
        transition: ease-in-out 0.5s;
    }

    .showSmart{
        left: 0px !important;
    }

    .mobileNav{
        width: 100vw;
        position: fixed;
        top: 0px;
        left: 0px;
        box-shadow: 0px 0px 3px lightgrey;
        background-color: white;
        padding: 20px;
        justify-content: space-between;
        align-items: center;
        z-index: 99999;
        display: none;
    }

    .mobileIcon{
        font-size: 200%;
    }


    /*.shopBasket:hover   .forShortCart{*/
        /*display: block;*/
        /*transition: ease-in-out 0.3s;*/
        /*opacity: 1;*/

    /*}*/

    .forShortCart{
        width: 400px;
        position: absolute;
        top: 30px;
        right: -20px;
        /*top: 55px;*/
        /*right: -20px;*/
        /*display: none;*/
        transition: ease-in-out 0.3s;
        /*opacity: 0;*/
        z-index: 9999;
    }


    section{
        width: 100vw;
    }

    .circleCount{
        width: 17px;
        height: 17px;
        position: absolute;
        top: -5px;
        left: 16px;
        background: black;
        border-radius: 100%;
        font-size: 10px;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .myNav{
        width: 100%;
        display: flex;
        background-color: white;
        padding: 20px;
        /*margin-bottom: 50px;*/
        align-items: center;
        justify-content: space-between;
        box-shadow: 0px 0px 3px lightgrey;
    }
    .logo{
        font-family: 'Marck Script', cursive;
        font-size: 160%;
        cursor: pointer;
    }

    a{
        color: grey;
        margin-left: 10px;
        font-size: 110%;
    }
    a:hover{
        color: black;
        text-decoration: none;
    }
    .router-link-exact-active {
        color: black;
    }


    .shopBasket{
        margin-left: 10px;
        cursor: pointer;
        font-size: 120%;
        position: relative;
        color: black;

    }




    @media screen and (max-width: 700px) {
        .myNav{
            display: none;
        }
        .smartMenu{
            display: block;
        }

        .mobileNav{
            display: flex;
            position: fixed;
        }

        .circleCount{
            left: 14px;
        }
        .container{
            border-bottom: 0px solid transparent !important;
        }

        .circleCount{
            background: black;
            color: white;
        }
        }
</style>

<script>

    import axios from 'axios'
    import { mapActions, mapGetters } from "vuex";
    import ShortCart from '../components/ShortCart.vue'
  //  import CreditCard from '../components/CreditCard.vue'



    export default {

        name: "Navbar",

        components: {
            ShortCart
        },

        data(){
            return{
                searchQuery: '',
                openMenu : false,
                hideCart: true
            }
        },

        computed : {

            ...mapGetters(["cartCount"]),
            ...mapGetters(["user"]),
        },

       methods: {
           ...mapActions(['GET_SEARCH_PRODUCTS']),
           ...mapActions(['SET_SEARCH']),
           ...mapActions(['LOGOUT_USER']),


           mouseOver(){
               if(this.$route.name === 'Cart' || this.$route.name === 'Deliver'){
                   this.hideCart = true
               } else{
                   this.hideCart = false
               }
           },
           mouseLeave(){
               this.hideCart = true
           },

           forMenu(){
               this.openMenu = !this.openMenu
               if (this.openMenu){
                   document.body.style.overflow = 'hidden';

               } else{
                   document.body.style.overflow = 'scroll';
               }
           },

           logout(){
               this.LOGOUT_USER().then(response => {
                   this.$snotify.simple("Bye !" );
               })
           },
           goSearch(){

               if (this.searchQuery.trim().length > 0) {
                   this.SET_SEARCH(this.searchQuery)
                   let query = {
                       query : this.searchQuery,
                       page: 1
                   }
                   this.GET_SEARCH_PRODUCTS(query)
                   this.$router.push({path: `/Result`})
               }

            },

           goToCart(){
               this.$router.push({path: `/Cart`})
           }
       }

    }

</script>


