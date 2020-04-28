<template>
    <div class="myNav">
        <router-link :to="{ path: '/' }">
            <span
                    class="logo"
                    style="color: black"
            >
                Sneakers-X
            </span>
        </router-link>

        <div class="d-flex align-items-center">
            <div class="form-inline d-flex justify-content-center">
                <i class="fas fa-search" aria-hidden="true"></i>
                <input class="form-control form-control-sm ml-2 w-75" type="text" placeholder="Search"
                       aria-label="Search">
            </div>

            <router-link :to="{ path: '/News' }">News</router-link>
            <router-link :to="{ path: '/Catalogue' }">Catalogue</router-link>
            <router-link :to="{ path: '/Contact' }">Contact</router-link>
            <router-link :to="{ path: '/Login' }">Login</router-link>
            <router-link :to="{ path: '/Register' }">Register</router-link>
            <span class="shopBasket"><i class="fas fa-shopping-cart"></i></span>
        </div>
    </div>
</template>

<style scoped>

    .myNav{
        display: flex;
        background-color: white;
        padding: 20px;
        margin-bottom: 50px;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid lightgrey;
        box-shadow: 0px 0px 10px lightgrey;
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

    }
</style>

<script>

    export default {

        name: "Navbar",

        mounted(){
            console.log("nav")
        }

    }

</script>


