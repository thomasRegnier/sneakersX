<template>
    <div>
        <button @click="hasHistory() ? $router.go(-1) : $router.push('/')" style="background: black" class="btn btn-dark myBut">Retour</button>
    </div>
</template>


<style scoped>
    div{
        padding: 20px;
    }

    @media screen and (max-width: 700px) {

        div{
            padding-top: 106px;

        }
    }
</style>
<script>
    export default {
        methods:{
            hasHistory () { return window.history?.length > 2 }

        }
    }
</script>
