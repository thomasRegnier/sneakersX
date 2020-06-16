<template>
    <div class="fond">
        <div class="d-flex forForm">
            <div class="d-flex justify-content-center align-items-center leftForm">
                Sneakers-x
            </div>
            <div class="myForm">
                <h3 class="titleResp">Inscription</h3>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                        </div>
                        <input
                                :class="{'is-invalid' : $v.user.firstname.$error}"
                                v-model="user.firstname"
                                type="text"
                                class="form-control"
                                placeholder="Prénom"
                        >
                    </div>

                    <div style="height: 23px">
                        <div  v-if="$v.user.firstname.$dirty">
                            <small class="error" v-if="!$v.user.firstname.required">Prénom obligatoire</small>
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
                                    :class="{'is-invalid' : $v.user.name.$error}"
                                    v-model="user.name"
                                    type="text"
                                    class="form-control"
                                    placeholder="Nom"
                            >
                    </div>
                    <div style="height: 23px">
                        <div  v-if="$v.user.name.$dirty">
                            <small class="error" v-if="!$v.user.name.required">Name is required</small>
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
                        <input v-model="user.email"
                               type="email"
                               class="form-control"
                               id="exampleInputEmail1"
                               placeholder="Adresse email"
                               :class="{'is-invalid' : $v.user.email.$error}"
                        >
                    </div>
                    <div style="height: 23px">
                        <div  v-if="$v.user.email.$dirty">
                            <small class="error" v-if="!$v.user.email.required">Email is required</small>
                            <small class="error" v-if="!$v.user.email.email">Please enter correct email</small>

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                        </div>
                    <input
                            :class="{'is-invalid' : $v.user.password.$error}"
                            v-model="user.password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe">
                    </div>
                    <div style="height: 23px">
                        <div  v-if="$v.user.password.$dirty">
                            <small class="error" v-if="!$v.user.password.required">Password is required</small>
                            <small class="error" v-if="!$v.user.password.minLength">The password must be at least 4 characters.</small>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-unlock"></i>
                                    </span>
                        </div>
                        <input
                                :class="{'is-invalid' : $v.user.password_confirmation.$error}"
                                v-model="user.password_confirmation" type="password" class="form-control" id="exampleInputPassword12"
                                placeholder="Confirmer mot de passe">
                    </div>

                    <div style="height: 23px">
                        <div  v-if="$v.user.password_confirmation.$dirty">
                            <small class="error" v-if="!$v.user.password_confirmation.required">
                                Password confirmation is required
                            </small>
                            <small class="error" v-if="!$v.user.password_confirmation.sameAsPassword">
                                Passwords must be identical
                            </small>
                            <small class="error" v-if="!$v.user.password_confirmation.minLength">The password must be at least 4 characters.</small>

                        </div>
                    </div>
                </div>


                <div class="text-right">
                    <button @click="trySubmit" type="submit" class="btn btn-dark">Register</button>
                </div>
            </div>
        </div>
    </div>
</template>


<style scoped>
    .form-group{
        margin-bottom: 5px !important;
    }
</style>

<script>

  //  import axios from 'axios'

   // axios.defaults.withCredentials = true;
  import { mapActions } from "vuex";
  import { required, email, minLength, sameAs } from 'vuelidate/lib/validators'




  export default {

        data(){
            return{
                user:{
                    email: '',
                    password: '',
                    name:'',
                    password_confirmation: '',
                    firstname: ''
                }

            }
        },

      validations: {
          user:{
              email: {
                  required, email,
              },
              password: {
                  required,
                  minLength:  minLength(4)

              },
              name: {
                  required,

              },
              firstname: {
                  required,

              },
              password_confirmation: {
                  required,
                  minLength:  minLength(4),
                  sameAsPassword: sameAs('password')

              }
          }

      },
        methods:{

            ...mapActions(['REGISTER_USER']),

            trySubmit(){
                this.$v.$touch()
                if (this.$v.$invalid) {
                    //   this.$snotify.error("Something wrong !");

                } else {
                    this.register()
                }

            },
            register(){
                this.REGISTER_USER(this.user).then(response => {
                    this.$snotify.success("Welcome " + " " + response.data.user.name);
                    this.$router.push({name:'Home'})

                }).catch( (error) => {
                    if(error.response.data.error.email){
                        this.$snotify.error(error.response.data.error.email[0]);
                    }
                })
            }
        }
    }
</script>

