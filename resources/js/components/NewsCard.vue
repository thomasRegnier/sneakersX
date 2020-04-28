<template>
    <div>
        <div class="card newsCard">
            <img class="imgNews" :src="image">
            <div class="card-body insideNews">
                <article class="newsTitle">{{news.title}}</article>
                <article class="newsDesc">{{news.desc}}</article>
                <div class="forButt">
                    <article>{{moment(news.publish_at).format("LL")}}</article>

                    <button @click="goNews(news.id)" class="moreActu">Lire l'article</button>
                </div>
            </div>
        </div>
    </div>

</template>


<script>


    export default {
        props:{

            news:{
                type: Object
            }
        },


        computed: {
            image(){
                return 'storage/images/'+this.news.image
            }
        },

        methods: {

            goNews(elem){
                this.$router.push({path: `/News/${elem}`})
            }

        },

    }

</script>


<style scoped>
    .newsTitle{
        font-size: 150%;
        font-weight: bold;
    }


    .newsDesc{
        color: grey;
        padding: 10px 0px;
    }

    .forButt{
        display: flex;
        justify-content: space-between;
        align-items:center;
    }

    .newsCard{
        width: 400px;
        height: 500px;
        overflow: hidden;
        margin: 20px;
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

    .moreActu:hover{
        transform: scale(1.04);
        box-shadow: 0px 0px 10px lightgrey;
    }

    .imgNews{
        width: 100%;
    }

    .insideNews{
        display: flex;
        flex-direction: column;
        justify-content: space-between;

    }
</style>