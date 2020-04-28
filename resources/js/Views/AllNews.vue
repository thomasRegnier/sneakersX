<template>
    <div>
        <div class="newsContainer">
            <NewsCard v-for="(newOne, index) in news" :key="index" :news="newOne" />
        </div>
        <!--<div class="album py-5 bh-light">-->
            <!--<div class="container">-->
                <!--<div class="row">-->
                    <!--<div class="col-md-4" v-for="(newOne, index) in news" :key="index">-->
                        <!--<div class="card  box-shadow">-->
                            <!--<img class="card-img-top" style="height: 225px; width: 100%; display: block; object-fit: cover" :src="imagePath(newOne.image)"/>-->
                        <!--<div class="card-body">-->
                            <!--<p class="card-text">-->
                                <!--{{ newOne.title }}-->
                            <!--</p>-->
                            <!--<div class="d-flex justify-content-between align-items-center">-->
                                <!--<button @click="goNews(news.id)" class="moreActu">Lire l'article</button>-->
                                <!--<article>{{moment(newOne.publish_at).format("LL")}}</article>-->
                            <!--</div>-->

                        <!--</div>-->
                    <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
    </div>
</template>

<style>
    .newsContainer{
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin: auto;
        width: 90vw;

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
</style>

<script>

    import { mapGetters } from "vuex";

    import NewsCard from '../components/NewsCard.vue'

    export default {
        components: {
            NewsCard
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
