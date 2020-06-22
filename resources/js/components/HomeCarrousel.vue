<template>
    <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
        <!--Indicators-->
        <ol class="carousel-indicators">
            <li   data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
            <li             v-for="(news , index) in lastNews"
                            data-target="#carousel-example-2" :data-slide-to="index"></li>
        </ol>
        <!--/.Indicators-->
        <!--Slides-->
        <div class="carousel-inner" role="listbox">
            <!--<div class="carousel-item active">-->
                <!--<div class="view">-->
                    <!--<img class="d-block" style="width: 50vw; height: 60vh; object-fit: cover" src="storage/images/home.jpeg"-->
                         <!--alt="First slide">-->
                    <!--<div class="mask rgba-black-light"></div>-->
                <!--</div>-->
                <!--<div class="carousel-caption">-->
                    <!--<h3 class="h3-responsive">Light mask</h3>-->
                    <!--<p>First text</p>-->
                <!--</div>-->
            <!--</div>-->
            <div v-for="(news , index) in lastNews" class="carousel-item" :class="{active: index === 0}">
                <div class="view">
                    <img class="d-block forImgCarr" :src="imagePath(news.image)"/>
                    <div class="mask rgba-black-light"></div>
                </div>
                <div class="carousel-caption">
                    <h3 class="h3-responsive">{{ news.title }}</h3>
                    <p>{{ news.description }}</p>
                    <button @click="goNews(news.id)" class="buttonInsideNews">Lire</button>

                </div>
            </div>

        </div>
        <!--/.Slides-->
        <!--Controls-->
        <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        <!--/.Controls-->
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
                            console.log(res.data)
                            this.lastNews = res.data
                        }
                    }).catch(err => {
                    console.log(err)
                })
            },

            imagePath(elem){
                return elem
            },

            goNews(elem){
                this.$router.push({path: `/News/${elem}`})
            }
        }
    }
</script>

<style scoped>
    .forImgCarr{
        object-fit: cover;
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
        outline: none;
        margin: auto;
        transition: ease-in-out 0.3s;
        cursor: pointer;
    }

    .forImgCarr{
        width: 50vw; height: 60vh; object-fit: cover;
    }

    @media screen and (max-width: 700px) {

        .forImgCarr{
            width: 100vw;
        }
    }
</style>
