<template>
    <div style="padding-top: 100px">
        <h1 style="margin-bottom: 30px" class="text-center">
            {{ !forUpdate ? 'Ajouter une marque' : 'Modifer la marque'}}
        </h1>
        <form enctype="multipart/form-data" class="formActu">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                       <i class="fas fa-bookmark"></i>
                                    </span>
                    </div>
                    <input
                            :class="{'is-invalid' : $v.brand.name.$error}"
                            v-model="brand.name"
                            type="text"
                            class="form-control"
                            placeholder="Nom"
                    >
                </div>

                <div style="height: 23px">
                    <div  v-if="$v.brand.name.$dirty">
                        <small class="error" v-if="!$v.brand.name.required">Titre obligatoire</small>
                    </div>
                </div>
            </div>

            <div class="d-flex algin-items-center">
                 <span class="input-group-text" id="inputGroupFileAddon01" style="border-top-left-radius: 0.25rem; border-bottom-left-radius: 0.25rem; border-top-right-radius: 0px;border-bottom-right-radius: 0px ">
                          Logo
                 </span>
                <input

                        style="width: 100%; border: 1px dotted rgb(206, 212, 218); border-radius: 0.25rem"
                        type="file"
                        @change="onFileChange" accept="image/*"
                >
            </div>
            <div style="height: 23px">
                <div>
                    <small style="color: grey"  v-if="errorImg">Image is required</small>
                </div>
            </div>

            <div v-if="previewUrl" class="d-flex align-items-center justify-content-center" style="padding: 20px">
                <img style="max-width: 200px; margin: auto" :src="previewUrl" v-if="previewUrl">
            </div>

            <div v-if="forUpdate && !imageChange" class="d-flex align-items-center justify-content-center" style="padding: 20px">
                <img style="max-width: 200px; margin: auto" :src="brand.logo">
            </div>



            <div class="d-flex algin-items-center">
                 <span class="input-group-text" id="inputGroupFileAddon02" style="border-top-left-radius: 0.25rem; border-bottom-left-radius: 0.25rem; border-top-right-radius: 0px;border-bottom-right-radius: 0px ">
                          Banner
                 </span>
                <input

                        style="width: 100%; border: 1px dotted rgb(206, 212, 218); border-radius: 0.25rem"
                        type="file"
                        @change="onFileChangeBan" accept="image/*"
                >
            </div>
            <div style="height: 23px">
                <div>
                    <small style="color: grey"  v-if="errorImgBann">Image is required</small>
                </div>
            </div>

            <div v-if="previewUrlBann" class="d-flex align-items-center justify-content-center" style="padding: 20px">
                <img style="max-width: 200px; margin: auto" :src="previewUrlBann" v-if="previewUrlBann">
            </div>

            <div v-if="forUpdate && !bannerChange" class="d-flex align-items-center justify-content-center" style="padding: 20px">
                <img style="max-width: 200px; margin: auto" :src="brand.banner">
            </div>



            <div class="form-group" style="margin-top: 5px">
                <div class="d-flex align-items-center customLab" style="background: #e9ecef">
                   <span style="margin-right: 10px">
                        <i class="fas fa-book-open"></i>
                   </span>
                    <article>Description</article>
                </div>
                <div class="input-group">
                    <editor

                            v-model="brand.description"
                            style="width: 100% !important;"
                            apiKey="8vf43wtiicyswk0hqicglpxcti078xopl53rn6jvu0nlsu7b"
                            :init="{
                                  height: 250,
                                  menubar: false,
                                  plugins: [
                                    'advlist autolink lists link image charmap',
                                    'searchreplace visualblocks code fullscreen',
                                    'print preview anchor insertdatetime media',
                                    'paste code help wordcount table'
                                  ],
                                  toolbar:
                                    'undo redo | formatselect | bold italic | \
                                    alignleft aligncenter alignright | \
                                    bullist numlist outdent indent | help'
                                }"
                    >
                    </editor>
                </div>
                <div style="height: 23px">
                    <div  v-if="$v.brand.description.$dirty">
                        <small class="error" v-if="!$v.brand.description.required">Description is required</small>
                    </div>
                </div>
            </div>


            <div class="text-right">
                <button v-if="!forUpdate" v @click.prevent="trySubmit" type="submit" class="btn btn-dark">Enregistrer</button>
                <button v-else  @click.prevent="trySubmit" type="submit" class="btn btn-dark">Modifier</button>

            </div>
        </form>
        <Loading v-if="isLoading" />
    </div>
</template>


<script>
    import { required, email, minLength, sameAs } from 'vuelidate/lib/validators'
    import Editor from '@tinymce/tinymce-vue'

    import axios from 'axios'
    import moment from 'moment'
    import Loading from '../components/Loading.vue'


    export default {
        components: {
            editor: Editor,
            Loading
        },
        data(){
            return{
                brand:{
                    name: '',
                    content: '',
                    description:'',
                    banner: '',
                    logo: '',
                },

                imageUp: '',
                previewUrl: '',
                previewUrlBann: '',
                forUpdate: false,
                imageChange : false,
                bannerChange: false,
                isLoading: false




            }
        },

        validations: {
            brand:{
                name: {
                    required
                },
                description: {
                    required,

                }
            }

        },

        computed:{
            errorImg(){
                if (this.brand.logo.length === 0){
                    return true
                } else{
                    return false
                }
            },

            errorImgBann(){
                if (this.brand.banner.length === 0){
                    return true
                } else{
                    return false
                }
            },

        },

        mounted(){
            if (this.$route.params.id) {
                this.forUpdate = true
                this.getOneBr(this.$route.params.id)
            }

        },
        methods: {

            trySubmit() {
                this.$v.$touch()
                if (this.$v.$invalid) {
                    console.log("error")

                } else {
                    console.log("ok")
                    if (!this.previewUrl && !this.previewUrlBann && !this.forUpdate){
                        console.log("etes")
                        return
                    }

                    if (!this.forUpdate) {
                        this.saveNews()
                    } else{
                        this.updateNews()
                    }
                }

            },

            saveNews(){
                this.isLoading = true

                const data = new FormData();
                data.append('name', this.brand.name);
                data.append('description', this.brand.description);
                data.append('logo', this.brand.logo)
                data.append('banner', this.brand.banner);

                axios.post('/api/admin/brands', data).then(response => {
                    console.log(response)
                    this.isLoading = false

                    this.$router.push('/AdminBrand')

                }).catch( (error) => {
                    console.log(error.response.data.error)

                    let errors = error.response.data.error;
                    for (let field of Object.keys(errors)) {
                        this.$snotify.error(errors[field][0])
                    }
                })
            },

            updateNews(){
                this.isLoading = true
                const data = new FormData();
                data.append('name', this.brand.name);
                data.append('description', this.brand.description);
                data.append('logo', this.brand.logo)
                data.append('banner', this.brand.banner);

                axios.post(`/api/admin/brand/${this.$route.params.id}`, data).then(response => {
                    console.log(response)
                    this.isLoading = false
                    this.$router.push('/AdminBrand')

                }).catch( (error) => {
                    console.log(error.response.data.error)

                    let errors = error.response.data.error;
                    for (let field of Object.keys(errors)) {
                        this.$snotify.error(errors[field][0])
                    }
                })
            },

            onFileChange(event) {
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

                this.brand.logo = file


                const reader = new FileReader()

                let vm = this;
                reader.onload =  (e) => {
                    vm.previewUrl = e.target.result
                    // vm.news.image = e.target.result;
                }

                reader.readAsDataURL(file)
            },

            onFileChangeBan(event) {
                if (this.forUpdate){
                    this.bannerChange = true
                }
                const file = event.target.files[0]
                if (!file) {
                    return false
                }
                if (!file.type.match('image.*')) {
                    return false
                }

                this.brand.banner = file


                const reader = new FileReader()

                let vm = this;
                reader.onload =  (e) => {
                    vm.previewUrlBann = e.target.result
                    // vm.news.image = e.target.result;
                }

                reader.readAsDataURL(file)
            },

            getOneBr(id){
                console.log(id, "lol")
                axios.get(`/api/admin/brands/${id}`)
                    .then(res => {
                        {
                            console.log(res.data)
                            this.brand = {...res.data}

                        }
                    }).catch(err => {
                    console.log(err)
                    this.$router.push({path:'/Page404'})

                })
            },

            imagePath(elem){
                return elem
            },


        }
    }
</script>


<style scoped>

    .formActu{
        width: 50vw;
        margin: auto;
        padding-bottom: 100px;
    }

    .customLab{
        border-top-right-radius: 0.25rem;
        border-top-left-radius: 0.25rem;
        color: #495057;
        padding: 0.375rem 0.75rem;

    }

    .customArea{
        border-bottom-left-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
        border-left: 1px solid #ced4da;
        border-right: 1px solid #ced4da;
        border-bottom: 1px solid #ced4da;
        border-top: 0px;
    }
    .tox-tinymce {
        width: 100% !important;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        display: none;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: 0.4s;
        transition: 0.4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: 0.4s;
        transition: 0.4s;
    }

    input:checked + .slider {
        background-color: #101010;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #101010;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
