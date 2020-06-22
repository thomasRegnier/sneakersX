<template>
    <div>
        <!--<GoBack/>-->
        <div class="container" style="border-bottom: 1px dotted black">
            <h1 style="padding-top: 50px" class="text-center">Actualitées</h1>
        </div>


        <div class="newsContainer">
            <!--<Skeleton v-for="number in 16" width="300"/>-->
            <NewsCard v-for="(newOne, index) in news" :key="index" :news="newOne" />
        </div>
    </div>
</template>

<style>
    .newsContainer{
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin: auto;
        width: 95vw;
        padding-top: 30px;
        padding-bottom: 80px;


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

    @media screen and (max-width: 700px) {
        .newsContainer {
            width: 100vw;
            padding-top: 10px;
        }
    }
</style>

<script>

    import { mapGetters } from "vuex";

    import NewsCard from '../components/NewsCard.vue'
    import GoBack from '../components/GoBack.vue'
    import Skeleton from '../components/Skeleton'

    export default {
        components: {
            NewsCard,
            GoBack,
            Skeleton
        },

        computed: {
            ...mapGetters(["news"]),
        },

        mounted() {
            this.$store.dispatch("GET_NEWS");
        },

        methods: {
            imagePath(elem){
                return 'storage/images/'+elem
            },
            goNews(elem){
                this.$router.push({path: `/News/${elem}`})
            }

        }


    }
</script>
