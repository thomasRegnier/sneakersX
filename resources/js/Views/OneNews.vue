<template>
    <div>
        <GoBack />
        <div class="oneNews">
            <h1 style="font-weight: bold">{{ oneNews.title }}</h1>
            <div class="oneNewsContainer">
               <div class="forImg">
                   <img  :src="image"/>
               </div>
                <div class="insideArt">

                    <article v-html="oneNews.content" class="contentNews">{{ oneNews.content }}</article>
                    <div style="padding-top: 20px">
                        <div  class="text-right forAuthor"><span class="mr-1">Écrit par : </span>{{ oneNews.author }}</div>
                        <div  class="text-right forAuthor">{{moment(oneNews.publish_at).format("LL")}}</div>
                    </div>
                </div>
            </div>
            <div class="moreLinks" style="padding-top: 20px">
                <router-link :to="{ path: '/news' }">Voir plus de news</router-link>
            </div>
        </div>

    </div>
</template>

<script>

    import axios from 'axios'
    import GoBack from '../components/GoBack.vue'
    export default {

        components:{
            GoBack
        },

        data(){
            return{
                    oneNews: ''
            }
        },

        mounted(){
            this.getOneNews(this.$route.params.id)
        },

        computed: {
            image(){
                return '/storage/images/'+this.oneNews.image
            }
        },

        methods: {
            getOneNews(id){
                axios.get(`/api/news/${id}`)
                    .then(res => {
                        {
                            console.log(res.data)
                            this.oneNews = {...res.data}
                        }
                    }).catch(err => {
                    console.log(err)
                    this.$router.push({path:'/Page404'})

                })
            }
        }



    }

</script>

<style scoped>


    a{
        color: black;
        text-decoration: underline;
    }
    .forImg{
        width: 50%;
    }

    .insideArt{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width: 50%;

    }

    .oneNewsContainer{
        display: flex;
    }
    .oneNews{
        width: 60%;
        margin: auto;
        font-size: 120%;
    }

    .contentNews{
        text-align: justify;
        padding-left: 20px;
    }

    .oneNews h1{
        padding-bottom: 5px;
    }

    .oneNews img{
        width: 100%;
    }

    .forAuthor{
        color: grey;
        font-weight: lighter;
        font-size: 80%;
    }

    .moreLinks{
        padding-bottom: 50px;
    }


    @media screen and (max-width: 800px) {

        .oneNews{
            width: 100vw;
        }
        .oneNewsContainer{
            flex-direction: column;
        }

        .forImg{
            width: 100%;
        }

        .insideArt{
            width: 100%;
        }
        .contentNews{

            padding: 10px;
        }

        .oneNews h1{
            padding: 0px 10px;
        }

        .forAuthor{
            padding: 0px 10px;
        }

        .moreLinks{
            padding-left: 10px;
        }
    }

</style>
