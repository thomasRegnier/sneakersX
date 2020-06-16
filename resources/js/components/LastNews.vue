<template>
    <div style="padding-top: 50px">
        <div class="container" style="border-bottom: 1px dotted black; margin-bottom: 50px" >
            <div style="padding: 10px">
                <h1 class="text-center">Last news</h1>
            </div>
        </div>
        <div class="forLastNews">
            <div class="insideLastNews" v-for="(news, index) in lastNews" :key="index"
                 :style="{ backgroundImage: 'url(' + imagePath(news.image) + ')' , }"
                 @click="goNews(news.id)"
            >
                <!--<img :src="imagePath(news.image)"/>-->
                <div class="maskNews">
                    <div class="forButtInsideNews">
                        <article class="lastNewsTitle">
                            {{ news.title }}
                        </article>
                        <button @click="goNews(news.id)" class="buttonInsideNews">Read article</button>
                    </div>
                </div>
            </div>
        </div>
        <!--<div style="font-size: 180%; color: grey" class="text-center pt-2"><i class="fas fa-arrows-alt-h"></i></div>-->
    </div>

</template>


<script>
    import axios from 'axios'

    export default {

        data(){
            return{
                lastNews: ''
            }
        },
        mounted(){

            this.getLatestNews()
        },

            methods: {
                getLatestNews(){
                   // axios.get(`/api/lastnews`)
                    axios.get('/api/news?max=5')
                        .then(res => {
                            {
                                this.lastNews = res.data
                            }
                        }).catch(err => {
                        console.log(err)
                    })
                },

                imagePath(elem){
                    return 'storage/images/'+elem
                },

                goNews(elem){
                    this.$router.push({path: `/News/${elem}`})
                }
            }
    }
</script>


<style scoped>
.forLastNews{
    width: 100vw;
    display: flex;
    overflow-x: scroll;
    overflow-y: hidden;
    overscroll-behavior-x: contain;
    scroll-snap-type: x mandatory;
}


/* total width */
.forLastNews::-webkit-scrollbar {
    background-color:#fff;
    width:16px
}

/* background of the scrollbar except button or resizer */
.forLastNews::-webkit-scrollbar-track {
    background-color:#fff
}
.forLastNews::-webkit-scrollbar-track:hover {
    background-color:#f4f4f4
}

/* scrollbar itself */
.forLastNews::-webkit-scrollbar-thumb {
    background-color:#babac0;
    border-radius:16px;
    border:5px solid #fff
}
.forLastNews::-webkit-scrollbar-thumb:hover {
    background-color:#a0a0a5;
    border:4px solid #f4f4f4
}

/* set button(top and bottom of the scrollbar) */
.forLastNews::-webkit-scrollbar-button {display:none}

    .insideLastNews{
        scroll-snap-align: center;
        max-width: 700px;
        min-width: 500px;
        height: 370px;
        background-size: cover;
        display: flex;
        cursor: pointer;
    }

.insideLastNews img{
    width: 100%;
    object-fit: cover;
}

    .lastNewsTitle{
        padding: 10px;
        font-size: 130%;
        font-weight: bold;
        color: white;
        transition: ease-in-out 0.3s;

    }

    .maskNews{
        max-width: 700px;
        min-width: 500px;
        height: 370px;
        background: rgb(0,0,0);
        background: linear-gradient(153deg, rgba(0,0,0,0.5032387955182073) 0%, rgba(0,0,0,0.5032387955182073) 100%);
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .buttonInsideNews{
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
        margin: auto;
        transition: ease-in-out 0.3s;
        opacity: 0;
        cursor: pointer;

    }


    .forButtInsideNews{
        text-align: center;
    }


    .maskNews:hover .buttonInsideNews{
        opacity: 1;
    }

@media screen and (max-width: 700px) {

    .maskNews, .insideLastNews{
        width: 100vw !important;
        min-width: 100vw;
        max-width: 100vw;

    }

    .buttonInsideNews{
        opacity: 1;
    }
}
</style>