<template>
    <div style="width: 600px">


        <CreditCard
            :cardNumber="card.number"
            :cardName="card.name"
            :cardMonth="card.month"
            :cardYear="card.year"
            :cardCvv="card.cvv"
            :isCardFlipped="isFlip"
            :amex-card-mask="card.number"
            :other-card-mask="card.number"
        />
        <article style="font-size: 120%; padding-top: 165px">
            Coordonnées Bancaire
        </article>

        <div style="padding-top: 15px;" class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-credit-card"></i>
                    </span>
                </div>
                <input :class="{'is-invalid' : $v.card.number.$error}"
                       v-model.trim="card.number" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                       placeholder="Numéro de carte"
                       v-number-only
                       maxlength="16"
                >
            </div>

            <div style="height: 23px">
                <div   v-if="$v.card.number.$error">
                    <small class="error" v-if="!$v.card.number.minLength || !$v.card.number.maxlength">Numéro de carte invalide</small>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                </div>
                <input :class="{'is-invalid' : $v.card.name.$error}"
                       v-model.trim="card.name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                       placeholder="Nom sur la carte">
            </div>

            <div style="height: 23px">
                <div   v-if="$v.card.name.$error">
                    <small class="error" v-if="!$v.card.name.required">Information obligatoire</small>
                </div>
            </div>
        </div>


        <div  class="form-group d-flex justify-content-between">
            <div style="width: 30%">
                <select   v-model.trim="card.month"
                          :class="{'is-invalid' : $v.card.month.$error}"
                          class="browser-default custom-select"
                >
                    <option value="" selected>Mois</option>
                    <option :value="n < 10 ? '0' + n : n" v-for="n in 12"  :key="n">
                        {{ n }}
                    </option>

                </select>

                <div style="height: 23px">
                    <div   v-if="$v.card.month.$error">
                        <small class="error" v-if="!$v.card.month.required">Information obligatoire</small>
                    </div>
                </div>
            </div>


            <div style="width: 30%">
                <select class="browser-default custom-select"
                        :class="{'is-invalid' : $v.card.year.$error}"
                        v-model="card.year" >
                    <option value="" selected>Year</option>
                    <option v-bind:value="$index + minCardYear" v-for="(n, $index) in 12" v-bind:key="n">
                        {{$index + minCardYear}}
                    </option>
                </select>
                <div style="height: 23px">
                    <div   v-if="$v.card.year.$error">
                        <small class="error" v-if="!$v.card.year.required">Information obligatoire</small>
                    </div>
                </div>
            </div>

            <div style="width: 30%">
                <div class="input-group">
                    <div class="input-group-prepend">
                                            <span class="input-group-text">
                                               <i class="fas fa-lock"></i>
                                            </span>
                    </div>
                <input :class="{'is-invalid' : $v.card.cvv.$error}"
                       v-model.trim="card.cvv" type="text" class="form-control"  aria-describedby="emailHelp"
                       placeholder="Code CVV"
                       @focus="isFlip = true"
                       @blur="isFlip = false"
                       maxlength="3"
                >
                </div>

                <div style="height: 23px">
                    <div   v-if="$v.card.cvv.$error">
                        <small class="error" v-if="!$v.card.cvv.required">Information obligatoire</small>
                    </div>
                </div>
            </div>


        </div>

        <div style="padding: 30px 0px" class="d-flex align-items-center justify-content-between">
            <span style="cursor: pointer" @click="returnOrder">
                Revenir à la commande
            </span>
            <button @click="trySubmit()" class="btn btn-dark">Payer</button>
        </div>
    </div>
</template>


<script>
    import { required, email, minLength, maxLength, numeric } from 'vuelidate/lib/validators'

    import CreditCard from '../components/CreditCard.vue'

    export default {
        components:{
            CreditCard
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

        data(){
            return{
                card:{
                    number: '',
                    name:'',
                    month: '',
                    year: '',
                    cvv:''
                },

                minCardYear: new Date().getFullYear(),
                readyPayment: true,
                isFlip: false,

            }
        },

        validations: {
            card:{
                number: {
                    required, numeric,
                    minLength: minLength(15),
                    maxLength: maxLength(16)
                },
                month: {
                    required, numeric
                },
                name: {
                    required
                },
                year: {
                    required
                },
                cvv: {
                    required
                }

            }

        },

        methods:{


            returnOrder(){

                this.$emit('returnOrder')
            },

            trySubmit(){
                this.$v.$touch()
                if (this.$v.$invalid) {
                    console.log("error")
                    //   this.$snotify.error("Something wrong !");

                } else {
                    console.log("ok")
                    this.$emit('paymentOk')
                   // this.readyPayment = true
                }
            },
        }

    }
</script>