<template>
    <div>
        <div  class="d-flex align-items-center forImgs" style="padding: 20px">
            <div class="insideImgs" v-for="img in product.images">
                <img style="max-width: 200px; margin: auto"  :src="imagePath(img.name)">
                <i @click="deleteSomething(img.id)" style="color: #ff6949; cursor: pointer" class="fas fa-trash-alt"></i>
            </div>
            <div v-if="isLoading">
                <MiniLoading />
            </div>

            <div class="image-upload">
                <label for="file-input">
                    <i style="font-size: 50px; cursor: pointer" class="fas fa-plus-circle"></i>
                </label>

                <input id="file-input" type="file" @change="onFileChangeMulti" accept="image/*"/>
            </div>

        </div>
    </div>
</template>


<script>

    import axios from 'axios'
    import Loading from '../components/Loading'
    import MiniLoading from '../components/MiniLoading'
    export default {
        components:{
            Loading,
            MiniLoading
        },
        props:{
            product:{
                required: true
            }
        },

        data(){
            return{
                previewUrlMulti: '',
                img: '',
                isLoading: false,
            }
        },
        methods:{
            onFileChangeMulti(event) {
                if (this.forUpdate){
                    this.imageChange = true
                }
                const file = event.target.files[0]
                if (!file) {
                    return false
                }
                if (!file.type.match('image.*')) {
                    return false
                }

                this.img = file


                const reader = new FileReader()

                let vm = this;
                reader.onload =  (e) => {
                    vm.previewUrlMulti = e.target.result
                    // vm.news.image = e.target.result;
                }

                reader.readAsDataURL(file)

                this.isLoading = true
                this.addImage()
            },

            imagePath(elem){
                return elem
            },

            deleteSomething(elem){
                this.isLoading = true
                axios.delete(`/api/admin/images/${elem}`).then(response => {
                    this.product.images.splice(this.product.images.findIndex(note =>  note.id === elem), 1)
                    this.isLoading = false
                }).catch( (error) => {
                    console.log(error.response.data.error)

                    let errors = error.response.data.error;
                    for (let field of Object.keys(errors)) {
                        this.$snotify.error(errors[field][0])
                    }
                })
            },

            addImage(){
                const data = new FormData();
                data.append('image', this.img);
                data.append('product_id', this.product.id);


                axios.post('/api/admin/images', data).then(response => {
                    console.log(response)
                    this.product.images.push(response.data.image)
                    this.isLoading = false

                }).catch( (error) => {
                    console.log(error.response.data.error)

                    let errors = error.response.data.error;
                    for (let field of Object.keys(errors)) {
                        this.$snotify.error(errors[field][0])
                    }

                    // this.$snotify.error(error.data.msg)
                })
            },
        }
    }
</script>


<style scoped>
    .forImgs{
        flex-wrap: wrap;
        justify-content: left;
    }

    .insideImgs{
        display: flex;
        flex-direction: column;
    }
    .image-upload > input {
        display: none;
    }

    .image-upload img {
        width: 80px;
        cursor: pointer;
    }
</style>