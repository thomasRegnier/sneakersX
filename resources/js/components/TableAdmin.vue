<template>
    <div style="width: 95vw; margin: auto">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="col-sm-4">
                        <h2>{{ title }}</h2>
                    </div>
                    <button @click="addSomething" style="background-color: white; color: #566787; padding: 5px 10px; border-radius: 5px">
                        <i class="fas fa-plus-circle"></i>
                        Ajouter
                    </button>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th  v-for="(field, index) in fields" :key="index">{{ field }}</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="(data, index) in datas" :key="index">
                        <td v-for="(column, indexCol) in columns" :key="indexCol">
                            <img v-if="column === 'image'" :src="imagePath(data['image'])">
                            <img class="logobrand" v-else-if="column === 'logo'" :src="imagePath(data['logo'])">
                            <img v-else-if="column === 'banner'" :src="imagePath(data['banner'])">
                            <span v-else-if="column === 'brand'">
                                {{ data['brand'].name }}
                                <img style="width: 50px" :src="data['brand'].logo">
                            </span>
                            <span v-else-if="column === 'active'">
                                {{ (data['active']) === 1 ? "Oui" : "Non" }}
                            </span>
                            <span v-else-if="column === 'publish_at'">
                                {{moment(data['publish_at']).format("LL")}}
                            </span>
                            <span v-else-if="column === 'images'">
                                <img style="width: 20px" v-for="(img , index) in data['images']" :src="imagePath(img.name)"/>
                            </span>
                            <span v-html="data['description']" v-else-if="column === 'description'">
                                {{data['description']}}
                            </span>
                           <span v-else>{{data[column]}}</span>
                        </td>
                        <td style="font-size: 120%">
                            <i @click="editSomething(data['id'])" style="color: dodgerblue; margin-right: 5px; cursor: pointer" class="far fa-edit"></i>
                            <i @click="deleteSomething(data['id'])" style="color: #ff6949; cursor: pointer" class="fas fa-trash-alt"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>


<script>
    export default {
        props:{
            title:{},
            fields:{},
            datas: {},
            columns: {}
        },

        mounted(){
            console.log(this.datas)
        },

        methods:{
            imagePath(elem){
                return elem
            },

            addSomething(){
                this.$emit("addItems")
            },

            editSomething(elem){
                this.$emit('editItems', elem)
            },

            deleteSomething(elem){
                this.$emit('deleteItems', elem)

            }
        }
    }
</script>

<style scoped>


    th{
        text-transform: uppercase;
    }
    img{
        width: 100px;
    }

    .logobrand{
        width: 50px !important;
    }
    body {
        color: #566787;
        background: #f5f5f5;
        font-family: 'Varela Round', sans-serif;
        font-size: 13px;
    }
    .table-wrapper {
        background: #fff;
        padding: 20px 25px;
        margin: 30px auto;
        border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
    .table-wrapper .btn {
        float: right;
        color: #333;
        background-color: #fff;
        border-radius: 3px;
        border: none;
        outline: none !important;
        margin-left: 10px;
    }
    .table-wrapper .btn:hover {
        color: #333;
        background: #f2f2f2;
    }
    .table-wrapper .btn.btn-primary {
        color: #fff;
        background: #03A9F4;
    }
    .table-wrapper .btn.btn-primary:hover {
        background: #03a3e7;
    }
    .table-title .btn {
        font-size: 13px;
        border: none;
    }
    .table-title .btn i {
        float: left;
        font-size: 21px;
        margin-right: 5px;
    }
    .table-title .btn span {
        float: left;
        margin-top: 2px;
    }
    .table-title {
        color: #fff;
        background: black;
        padding: 16px 25px;
        border-radius: 3px 3px 0 0;
    }
    .table-title h2 {
        margin: 5px 0 0;
        font-size: 24px;
    }
    .show-entries select.form-control {
        width: 60px;
        margin: 0 5px;
    }
    .table-filter .filter-group {
        float: right;
        margin-left: 15px;
    }
    .table-filter input, .table-filter select {
        height: 34px;
        border-radius: 3px;
        border-color: #ddd;
        box-shadow: none;
    }
    .table-filter {
        padding: 5px 0 15px;
        border-bottom: 1px solid #e9e9e9;
        margin-bottom: 5px;
    }
    .table-filter .btn {
        height: 34px;
    }
    .table-filter label {
        font-weight: normal;
        margin-left: 10px;
    }
    .table-filter select, .table-filter input {
        display: inline-block;
        margin-left: 5px;
    }
    .table-filter input {
        width: 200px;
        display: inline-block;
    }
    .filter-group select.form-control {
        width: 110px;
    }
    .filter-icon {
        float: right;
        margin-top: 7px;
    }
    .filter-icon i {
        font-size: 18px;
        opacity: 0.7;
    }
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
        padding: 12px 15px;
        vertical-align: middle;
    }
    table.table tr th:first-child {
        width: 60px;
    }
    table.table tr th:last-child {
        width: 80px;
    }
    table.table-striped tbody tr:nth-of-type(odd) {
        background-color: #fcfcfc;
    }
    table.table-striped.table-hover tbody tr:hover {
        background: #f5f5f5;
    }
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }
    table.table td a {
        font-weight: bold;
        color: #566787;
        display: inline-block;
        text-decoration: none;
    }
    table.table td a:hover {
        color: #2196F3;
    }
    table.table td a.view {
        width: 30px;
        height: 30px;
        color: #2196F3;
        border: 2px solid;
        border-radius: 30px;
        text-align: center;
    }
    table.table td a.view i {
        font-size: 22px;
        margin: 2px 0 0 1px;
    }
    table.table .avatar {
        border-radius: 50%;
        vertical-align: middle;
        margin-right: 10px;
    }
    .status {
        font-size: 30px;
        margin: 2px 2px 0 0;
        display: inline-block;
        vertical-align: middle;
        line-height: 10px;
    }
    .text-success {
        color: #10c469;
    }
    .text-info {
        color: #62c9e8;
    }
    .text-warning {
        color: #FFC107;
    }
    .text-danger {
        color: #ff5b5b;
    }
    .pagination {
        float: right;
        margin: 0 0 5px;
    }
    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }
    .pagination li a:hover {
        color: #666;
    }
    .pagination li.active a {
        background: #03A9F4;
    }
    .pagination li.active a:hover {
        background: #0397d6;
    }
    .pagination li.disabled i {
        color: #ccc;
    }
    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }
    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }
</style>
