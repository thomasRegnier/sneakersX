<template>
    <div>
        <TableAdmin title="Actualités"
                    :fields="fields"
                    :datas="news"
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
                news: '',
                fields: ["id", "titre", "image", "description", "publié", "actif"],
                column : ["id", "title", "image", "description" ,"publish_at", "active" ]
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
                axios.get('/api/admin/news')
                    .then(res => {
                        {
                            console.log(res.data)
                            this.news = res.data
                        }
                    }).catch(err => {
                    console.log(err)
                })
            },

            addActu(){
                console.log("add items")
                this.$router.push({path: '/ActuForm'})
            },

            editActu(param){
                console.log("edit items")
                this.$router.push({path: `/ActuForm/${param}`})

            },

            deleteActu(elem){
                console.log("delete items", elem)
                axios.delete(`/api/admin/news/${elem}`)
                    .then(res => {
                        {
                            console.log(res)
                            this.news.splice(this.news.findIndex(note =>  note.id === elem), 1)

                        }
                    }).catch(err => {
                    console.log(err)
                })
            }
        }

    }
</script>
