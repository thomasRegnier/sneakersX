<template>
    <div style="padding-top: 100px">
        <h1 style="margin-bottom: 30px" class="text-center">
         {{ !forUpdate ? 'Ajouter une actualité' : 'Modifer l\'actualité'}}
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
                            :class="{'is-invalid' : $v.news.title.$error}"
                            v-model="news.title"
                            type="text"
                            class="form-control"
                            placeholder="Titre"
                    >
                </div>

                <div style="height: 23px">
                    <div  v-if="$v.news.title.$dirty">
                        <small class="error" v-if="!$v.news.title.required">Titre obligatoire</small>
                    </div>
                </div>
            </div>




            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-book-reader"></i>
                                    </span>
                    </div>
                    <input
                            :class="{'is-invalid' : $v.news.description.$error}"
                            v-model="news.description"
                            type="text"
                            class="form-control"
                            placeholder="Description"
                    >
                </div>
                <div style="height: 23px">
                    <div  v-if="$v.news.description.$dirty">
                        <small class="error" v-if="!$v.news.description.required">Content is required</small>
                    </div>
                </div>
            </div>


            <div class="d-flex algin-items-center">
                 <span class="input-group-text" id="inputGroupFileAddon01" style="border-top-left-radius: 0.25rem; border-bottom-left-radius: 0.25rem; border-top-right-radius: 0px;border-bottom-right-radius: 0px ">
                            <i class="far fa-images"></i>
                 </span>
                <input

                        style="width: 100%; border: 1px dotted rgb(206, 212, 218); border-raidus: 0.25rem"
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
                <img style="max-width: 200px; margin: auto" :src="imagePath(news.image)">
            </div>

            <div class="form-group" style="margin-top: 5px">
                <div class="d-flex align-items-center customLab" style="background: #e9ecef">
                   <span style="margin-right: 10px">
                        <i class="fas fa-book-open"></i>
                   </span>
                    <article>Content</article>
                </div>
                <div class="input-group">
                    <!--<textarea-->
                                <!--id="mytextarea"-->
                              <!--class="form-control"-->
                              <!--:class="{'is-invalid' : $v.news.content.$error}"-->
                              <!--v-model="news.content"-->
                              <!--placeholder="Content"-->
                              <!--style="width: 100%; height: 150px; padding: 10px "-->
                    <!--&gt;-->

                    <!--</textarea>-->

                    <!-- initialValue="<p>Initial editor content</p>"-->
                    <editor

                            v-model="news.content"
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
                    <div  v-if="$v.news.content.$dirty">
                        <small class="error" v-if="!$v.news.content.required">Content is required</small>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                                    <span class="input-group-text" style="font-weight: bold">
                                        <i class="fas fa-user"></i>
                                    </span>
                    </div>
                    <input v-model="news.author"
                           type="text"
                           class="form-control"
                           id="exampleInputEmail1"
                           placeholder="Auteur"
                           :class="{'is-invalid' : $v.news.author.$error}"
                    >
                </div>
                <div style="height: 23px">
                    <div  v-if="$v.news.author.$dirty">
                        <small class="error" v-if="!$v.news.author.required">Auteur required</small>

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
                    <input v-model="news.publish_at"
                           class="form-control"
                           type="date"
                           id="example-date-input"
                           :class="{'is-invalid' : $v.news.publish_at.$error}"
                    >
                </div>
                <div style="height: 23px">
                    <div  v-if="$v.news.publish_at.$dirty">
                        <small class="error" v-if="!$v.news.publish_at.required">Date de publication obligatoire</small>

                    </div>
                </div>
            </div>

            <div>
                <label class="switch">
                    <input type="checkbox" v-model="news.active">
                    <div class="slider round"></div>
                </label>
            </div>
            <small>{{ news.active ? 'Actif' : "Inactif"}}</small>


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


    export default {
        components: {
            editor: Editor
        },
        data(){
            return{
                news:{
                    title: '',
                    content: '',
                    description:'',
                    author: '',
                    image: '',
                    publish_at: '',
                    active : '',
                    price: '',
                },

                imageUp: '',
                previewUrl: '',
                forUpdate: false,
                imageChange : false,


            }
        },

        validations: {
            news:{
                title: {
                    required
                },
                content: {
                    required,

                },
                description: {
                    required,

                },
                author: {
                    required,

                },
                publish_at: required
            }

        },

        computed:{
            errorImg(){
                if (this.news.image.length === 0){
                   return true
                } else{
                    return false
                }
            }
        },

        mounted(){

            if (this.$route.params.id) {
                this.forUpdate = true
                this.getOneNews(this.$route.params.id)
            }

            if (!this.forUpdate){
                this.news.active = 1
            }
        },
        methods: {

            trySubmit() {
                this.$v.$touch()
                if (this.$v.$invalid) {
                    console.log("error")

                } else {
                    console.log("ok")
                    if (!this.previewUrl && !this.forUpdate){
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

                const data = new FormData();
                data.append('image', this.news.image);
                data.append('description', this.news.description);
                data.append('contentNews', this.news.content)
                data.append('title', this.news.title);
                data.append('author', this.news.author)
                data.append('publish_at', this.news.publish_at)
                data.append('isActive', this.news.active)

                axios.post('/api/admin/news', data).then(response => {
                    this.$router.push('/AdminActu')

                }).catch( (error) => {
                    console.log(error.response.data.error)

                    let errors = error.response.data.error;
                    for (let field of Object.keys(errors)) {
                        this.$snotify.error(errors[field][0])
                    }

                    // this.$snotify.error(error.data.msg)
                })
            },

            updateNews(){

                this.news.active = this.news.active === false ? 0 : 1
                const data = new FormData();
                data.append('description', this.news.description);
                data.append('contentNews', this.news.content)
                data.append('title', this.news.title);
                data.append('author', this.news.author)
                data.append('image', this.news.image);
                data.append('publish_at', this.news.publish_at)
                data.append('isActive', this.news.active)

                axios.post(`/api/admin/news/${this.$route.params.id}`, data).then(response => {
                    this.$router.push('/AdminActu')

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

                this.news.image = file


                const reader = new FileReader()

                let vm = this;
                reader.onload =  (e) => {
                    vm.previewUrl = e.target.result
                   // vm.news.image = e.target.result;
                }

                reader.readAsDataURL(file)
            },

            getOneNews(id){
                axios.get(`/api/news/${id}`)
                    .then(res => {
                        {
                            this.news = {...res.data}
                            this.news.publish_at = moment(res.data.publish_at).format("YYYY-MM-DD")
                            this.news.active = res.data.active === 1 ? true : false
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