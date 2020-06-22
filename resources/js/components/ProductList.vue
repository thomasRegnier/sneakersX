<template>
    <div class="mainProduct">
        <div class="randomTitle">
            <h1 class="text-center d-flex justify-content-center align-items-center">
                {{ title }}
                <img class="forBrandLogo" v-if="logo" :src="imagePath(logo)" />
            </h1>
        </div>
        <!--<div style="width: 90vw; margin: auto">-->
            <!--<span style="margin-right: 20px">-->
                <!--Price-->
                <!--<i style="cursor: pointer" class="fas fa-sort" @click="sortByPrice"></i>-->
            <!--</span>-->
        <!--</div>-->
        <div class="forProducts">
            <div @click="goProduct(product.id)" class="prodCard" v-for="(product, index) in listProduct" :key="index" style="position: relative">

                <div class="overLay">
                    <i style="font-size: 25px; color: white" class="fas fa-search"></i>
                </div>

                <img class="imageProd" :src="imagePath(product.image)">
                <div class="insideProduct">
                    <article class="nameProd">{{ product.name }}</article>
                    <div  class="d-flex justify-content-between align-items-center forDetailsProd">
                        <b v-if="product.brand">{{ product.brand.name }}</b>
                        <article>
                            {{ product.price }} €
                        </article>
                    </div>
                    <!--<div style="padding-top: 10px" class="d-flex justify-content-between align-items-center">-->
                        <!--<article>-->
                            <!--{{ product.price }} €-->
                        <!--</article>-->
                        <!--&lt;!&ndash;<button&ndash;&gt;-->
                                <!--&lt;!&ndash;class="moreActu"&ndash;&gt;-->
                                <!--&lt;!&ndash;@click="goProduct(product.id)"&ndash;&gt;-->
                        <!--&lt;!&ndash;&gt;&ndash;&gt;-->
                            <!--&lt;!&ndash;Voir&ndash;&gt;-->
                        <!--&lt;!&ndash;</button>&ndash;&gt;-->
                    <!--</div>-->
                </div>
            </div>
        </div>
        <div v-if="withPaginate" class="container d-flex justify-content-center align-items-center" style="padding-top: 20px">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"
                        :class="{ disabled: products.current_page === 1 }"
                        @click="toPage(1)"
                    >
                        <a class="page-link" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>

                    <li class="page-item" v-for="page in products.last_page"  :class="{active: page === products.current_page }">
                        <a class="page-link"
                           @click="toPage(page)"
                        >
                            {{ page }}
                        </a>
                    </li>

                    <!--<li class="page-item active"><a class="page-link">1</a></li>-->
                    <!--<li class="page-item"><a class="page-link">2</a></li>-->
                    <!--<li class="page-item"><a class="page-link">3</a></li>-->

                    <li class="page-item" :class="{ disabled: products.current_page === products.last_page }">
                        <a class="page-link"  aria-label="Next"
                           @click="toPage(products.last_page)"
                        >
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>


<style scoped>

    .overLay{
        width: calc(100% + 20px);
        height: calc(100% + 20px);
        background: linear-gradient(153deg, rgba(0,0,0,0.10828081232492992) 100%, rgba(0,0,0,1) 100%);
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: ease 0.2s;
        padding: 30px;
        border-radius: 3px;
    }

    .overLay:hover{
        opacity: 1;

    }

    .forBrandLogo{
        width: 50px;
        margin-left: 10px;
    }

    li{
        cursor: pointer;
    }

    .page-item.active .page-link{
        background-color: black;
        color: white;
        border-color: black;
    }
    .insideProduct{
        padding: 0 1.25rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;

    }
    .mainProduct{
        width: 90vw;
        margin: auto;
        padding-bottom: 100px;
    }

    .forProducts{
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin: auto;
        width: 90vw;
    }
    .prodCard{
        width: 25%;
        margin: 20px;
        cursor: pointer;
    }


    .imageProd{
        width: 100%;
    }


    .nameProd{
        width: 100%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-weight: bold;
        font-size: 110%;
        font-family: 'Helvetica Neue','sans-serif';
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

    .forDetailsProd{
        padding-top: 5px;
    }

    @media screen and (max-width: 700px) {
      .forProducts{
          flex-direction: column;
      }

        .prodCard{
            width: 90%;
            padding-bottom: 20px;
            border-bottom: 1px solid lightgrey;
        }

        .insideProduct{
            height: auto;
        }

        .randomTitle{
            margin-top: 0px;
            margin-bottom: 20px;
        }

    }

</style>

<script>

    import { mapGetters, mapActions } from "vuex";

    export default {

        data(){
            return{
                priceSort: true,
            }
        },
        props:{
            listProduct:{},
            withPaginate: {
                type: Boolean,
            },
            brand: {},
            title: '',
            logo: ''
        },

        computed: {

            ...mapGetters(["products"]),
            ...mapGetters(["search"])

        },

        methods: {

            ...mapActions(['GET_PRODUCTS']),
            ...mapActions(['GET_ONE_BRAND']),
            ...mapActions(['GET_SEARCH_PRODUCTS']),


            toPage(elem){
                window.scroll(0, 0)

                if (this.search != null){
                    let query = {
                        query: this.search,
                        page : elem
                    }
                    this.GET_SEARCH_PRODUCTS(query)

                    return
                }

                if (this.brand === 'other'){
                    this.GET_PRODUCTS(elem)
                }
                else{
                    let request = {
                        brand: this.brand,
                        page: elem
                 }
                    this.GET_ONE_BRAND(request)
                }
            },


            imagePath(elem){
                return elem
            },

            sortByPrice(){
                this.priceSort = !this.priceSort
                if (!this.priceSort){
                    return  this.listProduct.sort( (a, b) => {return b.price - a.price  })
                } else {
                    return  this.listProduct.sort( (a, b) => {return  a.price - b.price  })

                }
            },

            goProduct(id){
                this.$router.push({path: `/Product/${id}`})
            }

        }
    }
</script>