<template>
    <div>
        <TableAdmin title="Produits"
                    :fields="fields"
                    :datas="brands"
                    :columns="column"
                    @addItems="addActu"
                    @editItems="editActu"
                    @deleteItems="deleteActu"
        />
    </div>
</template>

<script>


    import axios from 'axios'

    import TableAdmin from "../components/TableAdmin";

    export default {
        components: {TableAdmin},
        data(){
            return{
                brands: '',
                fields: ["id","image", "images", "name", "brand", "description", "price", "active"],
                column : ["id","image", "images", "name","brand", "description" ,"price", "active" ]
            }
        },

        beforeMount(){
            this.getPrd()
        },
        methods: {
            imagePath(elem){
                return 'storage/images/'+elem
            },

            getPrd(){
                axios.get('/api/admin/products')
                    .then(res => {
                        {
                            this.brands = res.data
                        }
                    }).catch(err => {
                    console.log(err)
                })
            },

            addActu(){
                this.$router.push({path: '/ProductForm'})
            },

            editActu(param){
                this.$router.push({path: `/ProductForm/${param}`})
            },

            deleteActu(elem){
                axios.delete(`/api/admin/product/${elem}`)
                    .then(res => {
                        {
                            this.brands.splice(this.brands.findIndex(note =>  note.id === elem), 1)

                        }
                    }).catch(err => {
                    console.log(err)
                })
            }
        }

    }
</script>
