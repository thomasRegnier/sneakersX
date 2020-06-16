<template>
        <!--PERSPECTIVE-->
        <div class="block dimension">
            <div class="cube-3d">
                <div class="back side"></div>
                <div class="left side"></div>
                <div class="right side"></div>
                <div class="top side"></div>
                <div class="bottom side"></div>
                <div class="front side"></div>
            </div>
        </div>
</template>


<script>
    export default {

    }
</script>

<style scoped lang="scss">
    //----------
    //VARIABLES
    //----------
    $grey:#333333;
    $grey-light:#444444;
    $body:#1E1F20;
    $dark:#2A2B2D;
    $green: #525252;
    $blue:#3275FF;
    $size:50px;
    $border:5px;
    $half-size:25px;
    $half-size-reverse:-25px;
    //----------
    //BASICS
    //----------
    body{
        background-color:$body;
    }
    section{
        height:100%;
        width:100%;
        display:flex;
        flex-wrap: wrap;
        padding-top:10vh;
        justify-content:center;
    }
    .header{
        display:flex;
        flex-direction:column;
        align-items:center;
    }
    .block{
        width:150px;
        height:150px;
        display:flex;
        justify-content:space-evenly;
        flex-direction:column;
        align-items:center;
    }
    .title{
        color:$green;
        font-size:36px;
        font-weight:800;
        margin-bottom:10px;
    }
    .text{
        color:$grey-light;
        font-size:12px;
        font-weight:200;
    }
    .font{
        font-family: 'IBM Plex Mono', monospace;
    }
    a:link {
        color: white;
        background-color: transparent;
    }
    a:visited {
        color: $grey-light;
        background-color: transparent;
    }
    a:hover {
        color: $green;
        background-color: transparent;
        text-decoration: underline;
    }

    //----------
    //PERSPECTIVE
    //----------
    .dimension{
        perspective:400px;
        perspective-origin:center center;
    }
    .side,
    .cube-3d{
        width:$size;
        height:$size;
    }
    .cube-3d{
        transform-style:preserve-3d;
        animation:rotate 7s cubic-bezier(0.75, 0, 0.5, 1) infinite;
    }
    .side{
        position:absolute;
        width:$size;
        height:$size;
        box-sizing:border-box;
        border:5px solid $green;
        opacity:.7;
        animation:color 7s cubic-bezier(0.75, 0, 0.5, 1) infinite;
    }

    .back{
        transform:translateZ($half-size-reverse);
        background:$grey;
    }
    .left{
        transform:translateX($half-size-reverse) rotateY(90deg);
        background:$grey;
    }
    .right{
        transform:translateX($half-size) rotateY(90deg);
        background:$grey;
    }
    .top{
        transform:translateY($half-size-reverse) rotateX(90deg);
        background:$grey;
    }
    .bottom{
        transform:translateY($half-size) rotateX(90deg);
        background:$grey;
    }
    .front{
        transform:translateZ($half-size);
        background:$grey;
    }
    @keyframes rotate{
        0%{
            transform:rotateX(90deg);
        }
        25%{
            transform:rotateY(90deg);
        }
        50%{
            transform:rotateZ(90deg);
        }
        75%{
            transform:rotateY(90deg);
        }
        100%{
            transform:rotateX(90deg);
        }
    }
    @keyframes color{
        0%{
            border:5px solid $grey;
            background:$green;
        }
        25%{
            border:5px solid $green;
            background:$grey;
        }
        50%{
            border:5px solid $grey;
            background:$green;
        }
        75%{
            border:5px solid $green;
            background:$grey;
        }
        100%{
            border:5px solid $grey;
            background:$green;
        }
    }
</style>