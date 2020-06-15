<template>
    <div class="myfooter">
        <div class="foot">
            <div class="d-flex" style="margin-right: 50px">
                <div style="margin-right: 50px">
                    <article class="logo">
                        Sneakers-x
                    </article>
                    <article style="margin-bottom: 20px">
                        19 rue Yves Toudic 75010 Paris
                    </article>
                    <article>Horaires : </article>
                    <article>Lundi au  Samedi 10h - 20h</article>
                </div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.3564642210517!2d2.360851415629936!3d48.8704807792888!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e0950555883%3A0x25e6ea66d950d9ec!2s19%20Rue%20Yves%20Toudic%2C%2075010%20Paris!5e0!3m2!1sfr!2sfr!4v1588667857226!5m2!1sfr!2sfr" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
            <div class="footerLinks">
                <router-link :to="{ path: '/' }">Home</router-link>
                <router-link :to="{ path: '/News' }">News</router-link>
                <router-link :to="{ path: '/Catalogue' }">Catalogue</router-link>
                <router-link :to="{ path: '/Contact' }">Contact</router-link>
                <router-link :to="{ path: '/Login' }">Login</router-link>
                <router-link :to="{ path: '/Register' }">Register</router-link>
            </div>
        </div>
        <div class="text-right pt-2">
            Copyright © 2020 Tous droits réservés
        </div>
    </div>

</template>

<script>
    export default {
        name: 'MyFoot'
    }
</script>

<style scoped>

    .logo{
        font-family: 'Marck Script', cursive;
        font-size: 170%;
    }

    .myfooter{
        background-color: black;
        padding: 50px;
        color: white;

    }
    .foot{
        display: flex;
    }

    .footerLinks{
        display: flex;
        flex-direction: column;
    }

    .footerLinks a{
        color: white;
        margin-bottom: 20px;
    }

    @media screen and (max-width: 700px) {
        iframe{
            width: 100px;
            height: 100px;
        }
        .foot{
           flex-direction: column;
        }
    }
</style>
