<template>
        <div class="card newsCard">
            <div>
                <img class="imgNews" :src="image">
            </div>
            <div class="insideNews">
                <article class="newsTitle">{{news.title}}</article>
                <article class="newsDesc">{{news.desc}}</article>
            </div>
            <div class="overLay">
                <button @click="goNews(news.id)" class="moreActu">Lire l'article</button>
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
                return this.news.image
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
        width: 300px;
        overflow: hidden;
        margin: 20px;
        position: relative;
        border: none !important;
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

    .imgNews{
        width: 100%;
        height: 200px;
        objectif-fit: cover;
    }

    .insideNews{
        display: flex;
        flex-direction: column;
        justify-content: space-between;

    }

    .overLay{
        width: 100%;
        height: 100%;
        background: linear-gradient(153deg, rgba(0,0,0,0.36878501400560226) 100%, rgba(0,0,0,1) 100%);
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: ease 0.2s;
    }

    .overLay:hover{
        opacity: 1;

    }

    @media screen and (max-width: 700px) {
        .newsCard{
            height: auto;
            margin: 0;
            width: 100%;
        }

        .imgNews {
            width: 100%;
            height: auto;
        }

        .card{
            border-radius: 0px !important;
            border: none;
        }
    }
</style>