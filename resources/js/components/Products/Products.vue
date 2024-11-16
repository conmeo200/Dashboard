<template>
    <div class="mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3">Product List</h1>
            <router-link to="/create-product" class="btn btn-dark">Add Product</router-link>
        </div>
        <table class="table table-striped table-hover shadow-sm">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID9999</th>
                <th scope="col">Name</th>
                <th scope="col">Type</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody v-for="(value, index) in products" :key="index" class="test">
            <tr>
                <td>#{{value.id}}</td>
                <td>{{value.name}}</td>
                <td>{{value.type_product_id}}</td>
                <td>{{value.price}}</td>
                <td>
                    <button class="btn btn-primary" @click="View(value.id)" style="margin-right: 10px;">View</button>
                    <button class="btn btn-danger" @click="handleDelete(value.id)">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
        <Pagination :pagination="paginationData" @page-changed="fetchProducts" />
        <Modal
        :isVisible="showModal"
        @close="showModal = false"
        :content="content_modal"
        :title="title_modal"
        >
            <CreateProduct
            :product     = "modelProduct"
            :isEditMode  = "isEditing"
            />
        </Modal>
    </div>
</template>

<script>
    import axios from 'axios';
    import Modal from '../Modal/Modal.vue';
    import CreateProduct from './CreateProduct.vue';
    import Pagination from '../Generate/Paginate.vue';

    export default {
        name: "Products",
        components: {
            Modal,
            CreateProduct,
            Pagination
        },
        data() {
            return {
                url_api      : process.env.VUE_APP_API_URL,
                products     : [],
                showModal    : false,
                name         : '',
                price        : 0,
                type         : '',
                images       : [],
                maxLength    : 10,
                leadingZero  : true,
                allowDecimal : false,
                errors       : {
                    name   : '',
                    price  : '',
                    type   : '',
                    images : '',
                },
                isEditing  : true,
                modelProduct      : {
                    id     : '',
                    name   : '',
                    price  : '',
                    images : '',
                    type   : '',
                },
                content_modal : '',
                title_modal   : '',
                paginationData : null
            };
        },
        mounted() {
            this.fetchProducts();
        },
        methods: {
            async fetchProducts(page = 1) {
                let url = this.url_api + '/products?page=' + page;
                try {
                    await axios
                        .get(url)
                        .then(response => {
                            var list   = response.data;
                            console.log(list);
                            if (list.data.length ) {
                                this.products       = list.data;
                                this.paginationData = list.pagination;
                            }

                        }).catch(error => {
                            this.errors = error.response.data.message;
                        });
                } catch (e) {
                    this.errors = e.response.data.message;
                }
            },
            handleDelete(id) {
                let url = this.url_api +  '/delete/';
                try {
                    axios
                        .delete(url + id)
                        .then(response => {
                            var list   = response.data;
                            if (list.data.length ) {
                                this.products = list.data;
                            }
                        }).catch(error => {
                        this.errors = error.response.data.message;
                    });
                } catch (e) {
                    this.errors = e.response.data.message;
                }
            },
            View(id) {
                let url = this.url_api + '/products/';
            console.log(url);
                this.showModal      = true;
                try {
                    axios
                        .get(url + id)
                        .then(response => {
                            var list   = response.data;

                            if (list.data) {
                                const data          = list.data;

                                this.modelProduct.id     = data.id;
                                this.modelProduct.name   = data.name;
                                this.modelProduct.price  = data.price;
                                this.modelProduct.images = data.images;
                                this.modelProduct.type   = data.type_product_id;
                                this.content_modal       = `Information`;
                                this.title_modal         = `Product # ${data.id}`;
                            }
                        }).catch(error => {this.errors = error.response.data.message;});
                } catch (e) {
                    this.errors = e.response.data.message;
                }
            }
        }
    };
</script>
<style scoped>
    .container {
        max-width: 800px;
    }

    .table {
        margin-top: 20px;
    }

    thead.thead-dark th {
        background-color: #343a40;
        color: #fff;
    }

    .shadow-sm {
        box-shadow: 0 .125rem .25rem rgba(0, 0, 0, 0.075) !important;
    }

    .d-flex {
        display: flex;
    }

    .justify-content-between {
        justify-content: space-between;
    }

    .align-items-center {
        align-items: center;
    }

    .mb-3 {
        margin-bottom: 1rem;
    }

    .mt-5 {
        margin-top: 3rem;
    }
</style>
