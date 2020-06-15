<template>
    <div>
        <div class="">
            <div class="" id="slider">
                <div id="myCarousel" class="carousel slide">
                    <!-- main slider carousel items -->
                    <div class="carousel-inner">
                        <div
                                v-for="(image, index) in images"
                                :key="index" class="carousel-item"
                                :data-slide-number="index"
                                :class="{active : index === 0}"
                        >
                            <img :src="imagePath(image.name)" class="img-fluid">
                        </div>


                        <a  class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                            <span aria-hidden="true" style="color: black; font-size: 30px">
                                <i class="fas fa-caret-left"></i>
                            </span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a  class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                            <span  aria-hidden="true" style="color: black; font-size: 30px">
                                <i class="fas fa-caret-right"></i>
                            </span>
                            <span class="sr-only">Next</span>
                        </a>

                    </div>
                    <!-- main slider carousel nav controls -->

                    <ul class="carousel-indicators list-inline mx-auto"
                    >
                        <!--<li class="list-inline-item active">-->
                            <!--<a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#myCarousel">-->
                                <!--<img src="http://placehold.it/80x60&amp;text=one" class="img-fluid">-->
                            <!--</a>-->
                        <!--</li>-->

                        <li
                                v-for="(image, index) in images"
                                :key="index"
                                :class="{active : index === 0}"
                                class="list-inline-item"
                        >
                            <a   :data-slide-to="index" data-target="#myCarousel" class="selected">
                                <img :src="imagePath(image.name)" class="img-fluid">
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

        </div>
        <!--/main slider carousel-->
    </div>
</template>


<script>
    export default {

        props :{
            images: {},
        },

        methods: {
            imagePath(elem){
                return '/storage/images/'+elem
            },
        }
    }
</script>

<style scoped>

    ul{
        margin-bottom: 0px;
    }
    #slider{
        width: 95%;
        margin: auto;
    }

    #myCarousel .list-inline {
        white-space:nowrap;
        overflow-x:auto;
    }

    #myCarousel .carousel-indicators {
        position: static;
        left: initial;
        width: initial;
        margin-left: initial;
    }

    #myCarousel .carousel-indicators > li {
        width: initial;
        height: initial;
        text-indent: initial;
    }

    #myCarousel .carousel-indicators > li.active img {
        opacity: 0.7;
    }

    .carousel-indicators img{
        width: 100px;
    }

</style>