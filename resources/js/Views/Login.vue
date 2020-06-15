<template>
    <div class="fond">
        <div class="d-flex forForm">
            <div class="d-flex justify-content-center align-items-center leftForm">
                Sneakers-x
            </div>
            <div class="myForm">
                <h3 class="titleResp">Connexion</h3>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                                    <span class="input-group-text" style="font-weight: bold">
                                        @
                                    </span>
                        </div>
                    <input :class="{'is-invalid' : $v.userForm.email.$error}"
                            v-model.trim="userForm.email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div style="height: 23px">
                        <div   v-if="$v.userForm.email.$error">
                                <small class="error" v-if="!$v.userForm.email.required">Email is required</small>
                                <small class="error" v-if="!$v.userForm.email.email">Please enter correct email</small>
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
                        <input :class="{'is-invalid' : $v.userForm.password.$error}"
                               v-model="userForm.password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div style="height: 23px">
                        <div  v-if="$v.userForm.password.$dirty">
                            <small class="error" v-if="!$v.userForm.password.required">Password is required</small>
                        </div>
                    </div>
                </div>

                <!--<div class="form-group">-->
                    <!--<input type="email" id="email" class="form-control" required>-->
                    <!--<label class="form-control-placeholder" for="email">Name</label>-->
                <!--</div>-->
                <!--<div class="form-group">-->
                    <!--<input type="password" id="password" class="form-control" required>-->
                    <!--<label class="form-control-placeholder" for="password">Password</label>-->
                <!--</div>-->

                <div class="text-right">
                    <button @click="trySubmit" class="btn btn-dark">Login</button>

                    <!--<button @click="login" class="btn btn-dark">Login</button>-->
                </div>

            </div>
        </div>
    </div>

</template>


<script>

//    import axios from 'axios'
//
//    axios.defaults.withCredentials = true;

import { mapGetters, mapActions } from "vuex";

import { required, email, minLength } from 'vuelidate/lib/validators'


    export default {

        data(){
            return{
                userForm:{
                    email: '',
                    password: ''
                },

            }
        },

        validations: {
            userForm:{
                email: {
                    required, email,
                },
                password: {
                    required,

                }
            }

        },

        mounted(){
            console.log(this.$router.history)

        },

        methods:{

            ...mapActions(['LOGIN_USER', 'GET_COOKIE']),

            trySubmit(){
                this.$v.$touch()
                if (this.$v.$invalid) {
                    console.log("error")
                 //   this.$snotify.error("Something wrong !");

                } else {
                    console.log("ok")
                    this.login()
                }

            },

            login(){

                this.GET_COOKIE().then(response => {

                    this.LOGIN_USER(this.userForm)
                        .then(response => {
                            console.log(response)
                            this.$snotify.success("Welcome " + " " + response.data.user.name);
                            this.$router.push({name:'Home'})

                        }).catch( (error) => {
                        console.error(error.response.data.message);
                        this.$snotify.error(error.response.data.message);

                    })

                }).catch(error => {
                    this.$snotify.error("Bad tokens");
                })

            }
        }
    }
</script>


<style lang="scss">

    .form-group{
        margin-bottom: 5px !important;
    }

    .form-control:focus{
        outline-color: transparent!important;
        box-shadow: none !important;
        border-color: #b8b8b8 !important;
    }

    .errorInput{
        border-color: #ff634a;
        transition: linear border 0.1s
    }

    .error{
        color: #ff634a;
    }

    .titleResp{
        display: none;
    }

    .form-group {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .form-control-placeholder {
        position: absolute;
        top: 0;
        padding: 7px 0 0 13px;
        transition: all 200ms;
        opacity: 0.5;
    }

    .form-control:focus + .form-control-placeholder,
    .form-control:valid + .form-control-placeholder {
        font-size: 100%;
        transform: translate3d(0, -100%, 0);
        opacity: 1;
    }

    .fond{
        width: 100vw;
        height: calc(100vh - 81px);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .forForm{
        width: 800px;
        box-shadow: 0px 0px 5px lightgrey;

    }

    .leftForm{
        width: 400px;
        background: black;
        color: white;
        font-family: 'Marck Script', cursive;
        font-size: 200%;
    }


    .myForm{
        width: 400px;
        height: 500px;
        background: white;
        padding: 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }



    @media screen and (max-width: 800px) {

        .leftForm{
            display: none !important;
        }

        .myForm{
            width: 100%;
            height: auto;
        }

        .forForm{
            box-shadow: none;
        }
        .fond{
            height: auto;
            padding-top: 100px;
        }

        .titleResp{
            display: block;
            text-align: center;
            padding: 10px;
        }
    }
</style>