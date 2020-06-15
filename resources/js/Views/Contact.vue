<template>
    <div>
            <div class="containerContact">
                <div class="contactbackground">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.356279146126!2d2.3608514158506178!3d48.87048430780893!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e0950555883%3A0x25e6ea66d950d9ec!2s19%20Rue%20Yves%20Toudic%2C%2075010%20Paris!5e0!3m2!1sfr!2sfr!4v1591105324580!5m2!1sfr!2sfr"
                            width="800"
                            height="600"
                            frameborder="0" style="border:0;"
                            allowfullscreen="" aria-hidden="false"
                            tabindex="0"></iframe>

                </div>
                <div  class="d-flex justify-content-center align-items-center">
                    <div class="contactForm">
                        <div class="text-right">
                            <span class="logo" style="color: black">Sneakers-X</span>

                        </div>
                        <div class='d-flex align-items-center justify-content-between' style="padding: 10px 0px;">
                            <article style="font-size: 170%">Contactez-nous</article>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </div>
                                <input
                                        :class="{'is-invalid' : $v.userForm.firstname.$error}"
                                        v-model="userForm.firstname"
                                        type="text"
                                        class="form-control"
                                        placeholder="Prénom"
                                >
                            </div>

                            <div style="height: 23px">
                                <div  v-if="$v.userForm.firstname.$dirty">
                                    <small class="error" v-if="!$v.userForm.firstname.required">Prénom obligatoire</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </div>
                                <input
                                        :class="{'is-invalid' : $v.userForm.name.$error}"
                                        v-model="userForm.name"
                                        type="text"
                                        class="form-control"
                                        placeholder="Nom"
                                >
                            </div>
                            <div style="height: 23px">
                                <div  v-if="$v.userForm.name.$dirty">
                                    <small class="error" v-if="!$v.userForm.name.required">Name is required</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="font-weight: bold">
                                        @
                                    </span>
                                </div>
                                <input v-model="userForm.email"
                                       type="email"
                                       class="form-control"
                                       id="exampleInputEmail1"
                                       placeholder="Adresse email"
                                       :class="{'is-invalid' : $v.userForm.email.$error}"
                                >
                            </div>
                            <div style="height: 23px">
                                <div  v-if="$v.userForm.email.$dirty">
                                    <small class="error" v-if="!$v.userForm.email.required">Email is required</small>
                                    <small class="error" v-if="!$v.userForm.email.email">Please enter correct email</small>

                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="input-group">
                                <textarea
                                        :class="{'is-invalid' : $v.userForm.message.$error}"

                                        v-model="userForm.message"
                                        class="form-control"style="height: 150px" placeholder="Message"></textarea>
                            </div>
                            <div style="height: 23px">
                                <div  v-if="$v.userForm.message.$dirty">
                                    <small class="error" v-if="!$v.userForm.message.required">Message is required</small>
                                </div>
                            </div>
                        </div>



                        <div class="text-right">
                            <button @click="trySubmit" type="submit" class="btn btn-dark">Envoyer</button>
                        </div>
                    </div>

                </div>
            </div>
    </div>
</template>

<script>

    import { required, email } from 'vuelidate/lib/validators'
    import axios from 'axios'
    import { mapGetters, mapActions } from "vuex";

    export default {
        data(){
            return{
                userForm:{
                    email: '',
                    name:'',
                    firstname: '',
                    message: '',
                }

            }
        },

        validations: {
            userForm:{
                email: {
                    required, email,
                },
                name: {
                    required,

                },
                firstname: {
                    required,

                },
                message:{
                    required
                }
            }

        },
        computed: {
            ...mapGetters(["user"]),
        },

        mounted(){
            if(this.user){
                this.userForm.email = this.user.email
                this.userForm.name = this.user.name
                this.userForm.firstname = this.user.firstname
            }
        },

        methods: {
            trySubmit(){
                this.$v.$touch()
                if (this.$v.$invalid) {
                    console.log("error")
                    //   this.$snotify.error("Something wrong !");

                } else {
                    console.log("ok")
                    this.sendMail()
                }

            },

            sendMail(){
                axios.post('api/contact', {userForm: this.userForm})
                    .then(response => {
                        console.log(response)
                        this.$snotify.success("Votre message a bien été envoyé");
                        if(!this.user){
                            this.userForm.email = ''
                            this.userForm.name = ''
                            this.userForm.firstname = ''
                            this.userForm.message = ''
                        } else {
                            this.userForm.message = ''
                        }

                    })
                    .catch(error => {
                        console.error(error);
                        this.$snotify.error("Something wrong !");

                    });
            }
        }
    }

</script>


<style scoped>

    .logo{
        font-family: 'Marck Script', cursive;
        font-size: 120%;
    }
    .contactForm{
        position: absolute;
        top: 100px;
        right: 20px;
        width: 400px;
        box-shadow: 0px 0px 3px lightgrey;
        background-color: white;
        padding: 50px;
        border-radius: 8px;
    }

    .containerContact{
        display: flex;

    }
    .contactbackground{
        width: 100vw;
        height: calc(100vh - 82px);
    }

    iframe{
        width: 100vw;
        height: calc(100vh - 82px);
    }

    @media screen and (max-width: 800px) {

        .contactbackground{
            display: none;
        }

        .contactForm{
            position: static;
            width: 100vw;
            box-shadow: 0px 0px 0px;
            background-color: white;
            padding: 50px;
            border-radius: 8px;
            margin-top: 86px;
        }

    }
</style>