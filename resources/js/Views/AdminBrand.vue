<template>
    <div>
        <TableAdmin title="Marques"
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
                fields: ["id", "name", "logo", "description", "banner"],
                column : ["id", "name", "logo", "description" ,"banner" ]
            }
        },

        beforeMount(){
            this.getNews()
        },
        methods: {
            imagePath(elem){
                return 'storage/images/'+elem
            },

            getNews(){
                axios.get('/api/admin/brands')
                    .then(res => {
                        {
                            this.brands = res.data
                        }
                    }).catch(err => {
                    console.log(err)
                })
            },

            addActu(){
                this.$router.push({path: '/BrandForm'})
            },

            editActu(param){
                this.$router.push({path: `/BrandForm/${param}`})
            },

            deleteActu(elem){
                 axios.delete(`/api/admin/brands/${elem}`)
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
