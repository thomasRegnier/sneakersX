<template>
        <!-- code here -->
        <div class="card" :style="{ width: width + 'px' }">
            <div class="card-img skeleton">
                <!-- waiting for img to load from javascript -->
            </div>
            <div class="card-body">
                <h2 class="card-title skeleton">
                    <!-- wating for title to load from javascript -->
                </h2>
                <p class="card-intro skeleton">
                    <!-- waiting for intro to load from Javascript -->
                </p>
            </div>
        </div>
</template>

<script>
    export default {
        props:{
            width:{}
        }
    }
</script>


<style scoped lang="scss">

    *, *:after, *:before {
        box-sizing: border-box;
    }

    body {
        font-family: "Inter", sans-serif;
        background-color: #f2f5f7;
    }

    // THE CARD
       .card {
           display: flex;
           flex-direction: column;
           background-color: #FFF;
           box-shadow: 0 5px 10px 0 rgba(#000, .15);
           border-radius: 10px;
           overflow: hidden;
           margin: 1rem;
       }

    .card-img {
        padding-bottom: 56.25%;
        position: relative;
    img {
        position: absolute;
        width: 100%;
    }
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-title {
        font-size: 1.25rem;
        line-height: 1.33;
        font-weight: 700;
    &.skeleton { // NOTICE THIS
     min-height: 28px;
         border-radius: 4px;
     }
    }

    .card-intro {
        margin-top: .75rem;
        line-height: 1.5;
    &.skeleton { // NOTICE THIS
     min-height: 72px;
         border-radius: 4px;
     }
    }

       .skeleton {
           background-color: #e2e5e7;
       background-image:
       linear-gradient(
       90deg,
       rgba(#fff, 0),
       rgba(#fff, 0.5),
       rgba(#fff, 0)
       );
           background-size: 40px 100%; // width of the shine
       background-repeat: no-repeat; // No need to repeat the shine effect
       background-position: left -40px top 0; // Place shine on the left side, with offset on the left based on the width of the shine - see background-size
       animation: shine 1s ease infinite; // increase animation time to see effect in 'slow-mo'
       }

    @keyframes shine {
        to {
        background-position: right -40px top 0;
        }
    }


                                  .container {
                                      position: absolute;
                                      top: 0;
                                      left: 0;
                                      right: 0;
                                      bottom: 0;
                                      width: 100%;
                                      display: flex;
                                      align-items: center;
                                      justify-content: center;
                                      flex-wrap: wrap;
                                  }
</style>