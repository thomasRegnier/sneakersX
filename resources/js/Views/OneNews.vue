<template>
    <div>
        <div class="oneNews">
            <h1 style="font-weight: bold">{{ oneNews.title }}</h1>
            <img style="width: 100%" :src="image"/>
            <article class="contentNews">{{ oneNews.content }}</article>
            <div style="color: grey" class="text-right">{{moment(oneNews.publish_at).format("LL")}}</div>
            <div style="color: grey" class="text-right "><span class="mr-1">Author : </span>{{ oneNews.author }}</div>

        </div>

    </div>
</template>

<script>

    import axios from 'axios'
    export default {


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
                })
            }
        }



    }

</script>

<style scoped>

    .oneNews{
        width: 60%;
        margin: auto;
    }

    .contentNews{
        text-align: justify;
        padding: 10px 0px;
    }

</style>
