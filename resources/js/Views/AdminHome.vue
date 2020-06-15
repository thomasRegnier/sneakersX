<template>
    <div>
        <div class="adminHome">
            <div style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                <article>Welcome to Admin</article>
                <span class="logo">Sneakers-X</span>
            </div>

        </div>
    </div>
</template>

<script>
    export default {

    }
</script>


<style scoped>
    .adminHome{
       width: 100vw;
       height: calc(100vh - 86px );
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 180%;
    }

    .logo{
        font-family: 'Marck Script', cursive;
    }
</style>