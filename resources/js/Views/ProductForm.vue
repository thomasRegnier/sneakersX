<template>
    <div style="padding-top: 100px">
        <h1 style="margin-bottom: 30px" class="text-center">
            {{ !forUpdate ? 'Ajouter un produit' : 'Modifier le produit'}}
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
                            :class="{'is-invalid' : $v.product.name.$error}"
                            v-model="product.name"
                            type="text"
                            class="form-control"
                            placeholder="Référence"
                    >
                </div>

                <div style="height: 23px">
                    <div  v-if="$v.product.name.$dirty">
                        <small class="error" v-if="!$v.product.name.required">Référence obligatoire</small>
                    </div>
                </div>
            </div>



            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                       <span class="input-group-text">
                          <i class="far fa-copyright"></i>
                       </span>
                    </div>
                <select class="form-control"
                        :class="{'is-invalid' : $v.product.brand_id.$error}"
                        v-model="product.brand_id"
                >
                    <option disabled >Choisir une marque</option>
                    <option :selected="brand.id === product.brand_id"  v-for="(brand, index) in brands" :value="brand.id">{{ brand.name }}</option>
                </select>
                </div>
                <div style="height: 23px">
                    <div  v-if="$v.product.brand_id.$dirty">
                        <small class="error" v-if="!$v.product.brand_id.required">Référence obligatoire</small>
                    </div>
                </div>
            </div>



            <div class="d-flex algin-items-center">
                 <span class="input-group-text" id="inputGroupFileAddon01" style="border-top-left-radius: 0.25rem; border-bottom-left-radius: 0.25rem; border-top-right-radius: 0px;border-bottom-right-radius: 0px ">
                          <i class="fas fa-camera-retro"></i>
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
                <img style="max-width: 200px; margin: auto" :src="imagePath(product.image)">
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

                            v-model="product.description"
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
                    <div  v-if="$v.product.description.$dirty">
                        <small class="error" v-if="!$v.product.description.required">Description is required</small>
                    </div>
                </div>
            </div>



            <div class="form-group" style="width: 300px">
                <div class="input-group">
                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                           €
                                        </span>
                    </div>
                <input :class="{'is-invalid' : $v.product.price.$error}"
                       v-model.trim="product.price" type="text" class="form-control"
                       placeholder="Prix"
                       v-number-only
                       maxlength="10"
                >
                </div>
                <div style="height: 23px">
                    <div  v-if="$v.product.price.$dirty">
                        <small class="error" v-if="!$v.product.price.required">Prix obligatoire</small>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-weight: bold">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                    </div>
                    <input v-model="product.publish_at"
                           class="form-control"
                           type="date"
                           id="example-date-input"
                           :class="{'is-invalid' : $v.product.publish_at.$error}"
                    >
                </div>
                <div style="height: 23px">
                    <div  v-if="$v.product.publish_at.$dirty">
                        <small class="error" v-if="!$v.product.publish_at.required">Date de publication obligatoire</small>
                    </div>
                </div>
            </div>


            <div>
                <label class="switch">
                    <input type="checkbox" v-model="product.active">
                    <div class="slider round"></div>
                </label>
            </div>
            <small>{{ product.active ? 'Actif' : "Inactif"}}</small>


            <div v-if="forUpdate">
                <SecondaryImg :product="product" />
            </div>

            <div class="text-right">
                <button v-if="!forUpdate" v @click.prevent="trySubmit" type="submit" class="btn btn-dark">Enregistrer</button>
                <button v-else  @click.prevent="trySubmit" type="submit" class="btn btn-dark">Modifier</button>

            </div>
        </form>
    </div>
</template>


<script>
    import { required, email, minLength, sameAs } from 'vuelidate/lib/validators'
    import Editor from '@tinymce/tinymce-vue'

    import axios from 'axios'
    import moment from 'moment'

    import { mapGetters, mapActions } from "vuex";

    import SecondaryImg from '../components/SecondaryImg'



    export default {
        components: {
            editor: Editor,
            SecondaryImg
        },
        data(){
            return{
                product:{
                    name: '',
                    content: '',
                    description:'',
                    image: '',
                    active: '',
                    price: '',
                    publish_at: '',
                    brand_id: '',
                    images : '',

                },

                imageUp: '',
                previewUrl: '',
                forUpdate: false,
                imageChange : false,
                imageChangeMulti : false,
                previewUrlMulti: '',



            }
        },

        validations: {
            product:{
                name: {
                    required
                },
                description: {
                    required,

                },
                price: {
                    required,

                },
                publish_at: {
                    required
                },
                brand_id:{
                    required
                }

            }

        },
        directives: {
            'number-only': {
                bind(el) {
                    function checkValue(event) {
                        event.target.value = event.target.value.replace(/[^0-9]/g, '')
                        if (event.charCode >= 48 && event.charCode <= 57) {
                            return true
                        }
                        event.preventDefault()
                    }

                    el.addEventListener('keypress', checkValue)
                }
            }
        },

        computed:{
            errorImg(){
                if (this.product.image.length === 0){
                    return true
                } else{
                    return false
                }
            },

            ...mapGetters(['brands'])


        },

        mounted(){
            this.GET_BRANDS()

            if (this.$route.params.id) {
                this.forUpdate = true
                this.getOneBr(this.$route.params.id)
            }

            if (!this.forUpdate){
                this.product.active = 1
            }

        },
        methods: {

            ...mapActions(['GET_BRANDS']),

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
                this.product.active = this.product.active === false ? 0 : 1

                const data = new FormData();
                data.append('name', this.product.name);
                data.append('description', this.product.description);
                data.append('brand_id', this.product.brand_id)
                data.append('price', this.product.price);
                data.append('image', this.product.image);
                data.append('publish_at', this.product.publish_at);
                data.append('active', this.product.active)


                axios.post('/api/admin/product', data).then(response => {
                    console.log(response)
                    this.$router.push('/AdminProducts')

                }).catch( (error) => {
                    console.log(error.response.data.error)

                    let errors = error.response.data.error;
                    for (let field of Object.keys(errors)) {
                        this.$snotify.error(errors[field][0])
                    }
                })
            },

            updateNews(){
                this.product.active = this.product.active === false ? 0 : 1

                const data = new FormData();
                data.append('name', this.product.name);
                data.append('description', this.product.description);
                data.append('brand_id', this.product.brand_id)
                data.append('price', this.product.price);
                data.append('image', this.product.image);
                data.append('publish_at', this.product.publish_at);
                data.append('active', this.product.active)

                axios.post(`/api/admin/product/${this.$route.params.id}`, data).then(response => {
                    console.log(response)
                    this.$router.push('/AdminProducts')

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

                this.product.image = file


                const reader = new FileReader()

                let vm = this;
                reader.onload =  (e) => {
                    vm.previewUrl = e.target.result
                    // vm.news.image = e.target.result;
                }

                reader.readAsDataURL(file)
            },

            getOneBr(id){
                axios.get(`/api/admin/product/${id}`)
                    .then(res => {
                        {
                            console.log(res.data)
                            this.product = {...res.data}
                            this.product.publish_at = moment(res.data.publish_at).format("YYYY-MM-DD")
                            this.product.active = res.data.active === 1 ? true : false

                        }
                    }).catch(err => {
                    console.log(err)
                    this.$router.push({path:'/Page404'})

                })
            },
            imagePath(elem){
                return '/storage/images/'+elem
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
