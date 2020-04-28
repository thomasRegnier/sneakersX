<template>
    <div>
        <div class="forProduct">
            <div class="leftProduct">
                <article class="productBrand">Adidas</article>
                <article class="productRef">Yeezy 700 MNVN Triple Black</article>
                <div class="secondaryImages">
                    <img src="/storage/images/y2.png"/>
                    <img src="/storage/images/y3.png"/>
                    <img src="/storage/images/y4.png"/>

                </div>
            </div>
            <div class="middleProduct">
                <img src="/storage/images/y1.png">
            </div>
            <div class="rightProduct">
                <div class="d-flex justify-content-between align-items-center">
                    <article><b>Size</b></article>
                    <select style="width: 60%">
                        <option>40</option>
                        <option>41</option>
                        <option>42</option>
                        <option>43</option>
                    </select>
                </div>
                <!--<div class="d-flex justify-content-between align-items-center" style="margin-top: 15px">-->
                    <!--<article><b>Color</b></article>-->
                    <!--<select style="width: 60%">-->
                        <!--<option>red</option>-->
                        <!--<option>blue</option>-->
                        <!--<option>black</option>-->
                    <!--</select>-->
                <!--</div>-->
                <div style="margin-top: 15px">
                    <div><b>Color</b></div>
                    <div class="d-flex mt-2">
                        <button type="button" class="btn btn-success btn-circle"></button>
                        <button type="button" class="btn btn-primary btn-circle"></button>
                        <button type="button" class="btn btn-danger btn-circle"></button>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center" style="margin-top: 15px">
                    <article><b>Price</b></article>
                    <article style="font-size: 120%">250 €</article>
                </div>
                <div style="margin-top: 30px">
                    <button class="moreActu">ADD TO CART</button>
                </div>

            </div>
        </div>
    </div>
</template>

<style scoped>

    .forProduct{
        width: 95vw;
        box-shadow: 1px 1px 6px rgba(0,0,0,0.4);
        margin: auto;
        display: flex;
        padding: 50px;
    }

    .productRef{
        font-size: 150%;
    }

    .productBrand{
        font-weight: bold;
        font-size: 200%;
    }

    .middleProduct{
        width: 60%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .middleProduct img{
        width: 100%;
    }
    .leftProduct, .rightProduct{
        width: 20%;

    }

    .secondaryImages{
        display: flex;
        flex-direction: column;
    }

    .leftProduct img{
        width: 150px;
        margin: 5px;
        cursor: pointer;
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

    .btn-circle.btn-xl {
        width: 70px;
        height: 70px;
        padding: 10px 16px;
        border-radius: 35px;
        font-size: 24px;
        line-height: 1.33;
    }

    .btn-circle {
        width: 30px;
        height: 30px;
        padding: 6px 0px;
        border-radius: 15px;
        text-align: center;
        font-size: 12px;
        line-height: 1.42857;
        margin-right: 10px;
    }

</style>

<script>
    export default {}
</script>